<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class QuotationController extends Controller
{
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
