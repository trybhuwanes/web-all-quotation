<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class priceService
{
    public function recalculateTotalPrice(Order $order)
    {
        // Hitung total harga dari order
        $originalTotalPrice = $order->items->sum(function ($item) {
            $product = $item->product;
            $productTypeId = $item->product_type;

            if ($product) {
                $specificationTypes = [
                    'specificationFas',
                    'specificationFmp',
                ];

                $productMainSpecification = null;
                $priceFromSpecification = null;

                foreach ($specificationTypes as $type) {
                    if ($product->{$type}->isNotEmpty()) {
                        $productMainSpecification = $product->{$type}->where('id', $productTypeId)->first();
                        if ($productMainSpecification) {
                            $priceFromSpecification = $productMainSpecification->harga;
                            break;
                        }
                    }
                }

                if ($priceFromSpecification) {
                    return $priceFromSpecification * $item->quantity;
                }
            }

            if ($item->productadd) {
                $price = $item->custom_price ?? $item->productadd->harga_produk_tambahan;
                return $price * $item->quantity;
            }

            return 0;
        });

        // Simpan subtotal ke order
        $order->subtotal = $originalTotalPrice;

        // Hitung diskon
        $discountValue = 0;
        if ($order->discount_type == 'fixed') {
            $discountValue = $order->discount_amount;
        } elseif ($order->discount_type == 'percentage') {
            $discountValue = $originalTotalPrice * ($order->discount_amount / 100);
        }

        // Total akhir
        $totalPrice = max(0, $originalTotalPrice - $discountValue + $order->shipping_cost);

        // Simpan total akhir ke order
        $order->total_price = $totalPrice;

        return $totalPrice;
    }
}
