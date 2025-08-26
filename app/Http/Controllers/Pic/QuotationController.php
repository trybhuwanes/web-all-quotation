<?php

namespace App\Http\Controllers\Pic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class QuotationController extends Controller
{
    //
    public function exportQoutationpdf(Request $request, $id)
    {
        // $orderfind = Order::with(['items.product', 'items.productadd', 'user'])->findOrFail($id);
            
        try {
            $orderfind = Order::where('id', $id)->with(['user', 'pic','revisiquotation', 'shipping', 'termpayment',
                                                    'items.product',    
                                                    'items.productadd'])->first();
                                                    
            // dd($orderfind->shipping->use_shipping_to_onsite);
            if (!$orderfind) {abort(404, 'Order not found');}
            
                                                        
            // Memastikan ada items dalam pesanan
            if ($orderfind->items->isNotEmpty()) {
                $firstItem = $orderfind->items[0];
                $product = $firstItem->product;
                $productId = $firstItem->product_id;
                $productTypeId = $firstItem->product_type;
        
                $specificationTypes = [
                    'specificationFas',
                    'specificationFmp',
                    // Nanti tambah disini untuk spesifikasi
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
                    dd('Spesifikasi tidak ditemukan untuk produk ini.');
                }

                $remainingRows = 17 - $orderfind->revisiquotation->count();
                $remainingRows = max($remainingRows, 0);

                return view($quotName, compact('orderfind', 'productMainSpecification', 'remainingRows'));
            } else {
                dd('Tidak ada item dalam pesanan.');
            }
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }
}
