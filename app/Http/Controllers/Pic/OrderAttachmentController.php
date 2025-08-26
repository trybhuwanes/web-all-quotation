<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderAttachmentController extends Controller
{
    public function store(Request $request, string $id)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // max 2048 KB = 2 MB
        ]);
        
        try {
            $order = Order::where('id', $id)
                ->select('id', 'attachment_path')
                ->firstOrFail();

            // Hapus file lama jika ada
            if ($order->attachment_path) {
                Storage::disk('public')->delete($order->attachment_path);
            }

            $fileName = null;

            if ($request->hasFile('file')) {
                $extension = $request->file('file')->getClientOriginalExtension();
                $fileName = 'uploads/attachments/attachment-' . $order->id . '-' . date('YmdHis') . '.' . $extension;

                // Simpan file dengan nama rapi ke folder uploads/attachments
                $request->file('file')->storeAs('uploads/attachments', basename($fileName), 'public');
            }

            $order->attachment_path = $fileName;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil disimpan.',
            ]);
        } catch (\Throwable $th) {
            // throw new \ErrorException($th->getMessage());
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]   , 500);
        }
    }


    public function storageDropzonePdf(Request $request) {
        $path = storage_path('app/public/pdf/attachment/tmp/');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function destroy(string $id)
    {
        try {
            $order = Order::where('id', $id)
                ->select('id', 'attachment_path')
                ->firstOrFail();

            // Hapus file fisik kalau ada
            if ($order->attachment_path && Storage::disk('public')->exists($order->attachment_path)) {
                Storage::disk('public')->delete($order->attachment_path);
            }

            // Hapus path dari database
            $order->attachment_path = null;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'File attachment berhasil dihapus.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


}
