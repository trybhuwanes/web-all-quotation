<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_order extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'detail_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'product_type', 'productadd_id', 'quantity', 'custom_price'];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productadd()
    {
        return $this->belongsTo(Additional_product::class);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->custom_price) {
            return $this->custom_price;
        }

        if ($this->productadd) {
            return $this->productadd->harga_produk_tambahan;
        }

        return 0;
    }
}
