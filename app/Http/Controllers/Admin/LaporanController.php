<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\ReportPresensi;
use App\Exports\LaporanExport;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     //
    //     $filter['search']  = $request->q;        
    //     $allPresensiWithPic = Presensi::whereHas('users')->filtering($filter)
    //     ->orderBy('created_at', 'asc')->paginate(10);

    //     return view('admin.laporan.index', compact('allPresensiWithPic'));
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $findreport = Presensi::with(['users', 'reportPresensis.detailReport'])->findOrFail($id);

        // return view('admin.laporan.show', compact('findreport'));        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportExcel(Request $request)
    {
        $filter['filter_periode'] = null;
        $data = Order::with(['items.product', 'items.productadd', 'user', 'shipping', 'pic'])->get();
        // dd($data);
        // $data = Order::whereHas('users')->with(['items.product', 'items.productadd', 'user'])->get();
        return Excel::download(new LaporanExport($data, $filter['filter_periode']), __('laporan-order') . '-' . now()->format('Ymd') . '.xlsx');
    }

    public function exportPdf(Request $request, $id)
    {
        try {
            $orderfind = Order::with(['items.product', 'items.productadd', 'user'])->findOrFail($id);
            return view('admin.order-admin.exports._pdf', compact('orderfind'));
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    public function exportQoutationpdf(Request $request, $id)
    {
        try {
            $orderfind = Order::where('id', $id)->with([
                'user',
                'pic',
                'revisiquotation',
                'shipping',
                'termpayment',
                'items.product',
                'items.productadd'
            ])->first();

            if (!$orderfind) {
                abort(404, 'Order not found');
            }

            if ($orderfind->items->isNotEmpty()) {
                $firstItem = $orderfind->items[0];
                $product = $firstItem->product;
                $productTypeId = $firstItem->product_type;

                $specificationTypes = [
                    'specificationFas',
                    'specificationFmp',
                    'specificationDiac',
                ];

                $productMainSpecification = null;
                $quotName = '';

                foreach ($specificationTypes as $type) {
                    if ($product->{$type}->isNotEmpty()) {
                        $productMainSpecification = $product->{$type}->where('id', $productTypeId)->first();

                        switch ($type) {
                            case 'specificationFas':
                                $quotName = 'admin.order-admin.exports._quotation-fas';
                                break;
                            case 'specificationFmp':
                                $quotName = 'admin.order-admin.exports._quotation-mps';
                                break;
                            case 'specificationDiac':
                                $quotName = 'admin.order-admin.exports._quotation-diac';
                                break;
                            default:
                                $quotName = 'admin.order-admin.exports._quotation-default';
                                break;
                        }
                        break;
                    }
                }

                if (!$productMainSpecification) {
                    abort(404, 'Spesifikasi tidak ditemukan untuk produk ini.');
                }

                $remainingRows = 17 - $orderfind->revisiquotation->count();
                $remainingRows = max($remainingRows, 0);

                // === 1. Generate PDF dari Blade ===
                $pdf = Pdf::loadView($quotName, [
                    'orderfind' => $orderfind,
                    'productMainSpecification' => $productMainSpecification,
                    'remainingRows' => $remainingRows,
                ]);

                $pdf->setPaper('A4', 'potrait');
                // pastikan folder temp ada
                $tempPath = storage_path("app/temp");
                if (!file_exists($tempPath)) {
                    mkdir($tempPath, 0777, true);
                }


                // === Generate nama file dinamis ===
                $customerName = $orderfind->user->company ?? 'customer';
                $dateExport   = now()->format('Ymd');

                // amanin spasi/karakter khusus
                $customerName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $customerName);

                $generatedPath = $tempPath . "/quotation_{$orderfind->id}.pdf";
                $pdf->save($generatedPath);


                // === 2. Siapkan file untuk merge ===
                $filesToMerge = [$generatedPath];

                // ambil file dari kolom `attachment_path` dan back cover
                $backCoverPath = public_path('./quot/back-cover.pdf');
                if ($orderfind->attachment_path) {
                    $attachmentFullPath = public_path('storage/' . $orderfind->attachment_path);

                    if (file_exists($attachmentFullPath)) {
                        $filesToMerge[] = $attachmentFullPath;
                    }

                    if (file_exists($backCoverPath)) {
                        $filesToMerge[] = $backCoverPath;
                    }
                } else {
                    if (file_exists($backCoverPath)) {
                        $filesToMerge[] = $backCoverPath;
                    }
                }

                // === 3. Merge file PDF ===
                $mergedPath = $tempPath . "/merged_quotation_{$orderfind->id}.pdf";
                $this->mergePdfs($filesToMerge, $mergedPath);

                return response()->file($mergedPath, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Quotation_' . $customerName . '_' . $dateExport . '.pdf"',
                ]);
            } else {
                abort(404, 'Tidak ada items dalam pesanan.');
            }
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }

    /**
     * 
     */
    private function mergePdfs(array $files, string $outputPath)
    {
        $pdf = new Fpdi();

        foreach ($files as $file) {
            $pageCount = $pdf->setSourceFile($file);

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $tplId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($tplId);

                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useTemplate($tplId);
            }
        }

        $pdf->Output($outputPath, 'F');
    }
}
