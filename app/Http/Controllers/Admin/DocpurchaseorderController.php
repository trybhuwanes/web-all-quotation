<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocpurchaseorderController extends Controller
{
    //
    public function po(Request $request, string $id)
    {
        //
        // dd($request->all());
        try {
            // DB::beginTransaction();
            $path = null;
            if ($request->hasFile('file')) {
                // Simpan file ke direktori storage/uploads/documents
                $path = $request->file('file')->store('uploads/documents', 'public');
            }

            // dd($path);
            $order = Order::where('id', $id)->select('id','status', 'po_path')->firstOrFail();
            
            $order->po_path = $path;
            $order->status = OrderStatusEnum::completed->value;
            $order->save();


            return response()->json([
                'success' => true,
                'message' => 'File berhasil disimpan.',
            ]);
            
        } catch (\Throwable $th) {
            // DB::rollBack();
            throw new \ErrorException($th->getMessage());
        }

    }
    
    public function storageDropzonePdf(Request $request) {
        $path = storage_path('app/public/pdf/po/tmp/');

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
}
