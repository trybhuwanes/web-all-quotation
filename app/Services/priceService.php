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
        $originalTotalPrice = $order->items->sum(function($item) {
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
                return $item->productadd->harga_produk_tambahan * $item->quantity;
            }

            return 0;
        });

        // Tambahkan biaya pengiriman jika ada
        $totalPrice = $originalTotalPrice + ($order->shipping->shipping_cost ?? 0);

        // Kurangi nilai diskon jika ada
        if ($order->discount_type == 'fixed') {
            $totalPrice = max(0, $totalPrice - $order->discount_amount);
        } elseif ($order->discount_type == 'percentage') {
            $discountValue = $totalPrice * ($order->discount_amount / 100);
            $totalPrice = max(0, $totalPrice - $discountValue);
        }

        return $totalPrice;
    }

}