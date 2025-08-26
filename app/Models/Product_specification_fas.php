<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_specification_fas extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'product_specification_fas';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id',
                            'type_name',
                            'harga',
                            'power_hp',
                            'power_kw',
                            'aerator_sotr',
                            'aerator_md',
                            'aerator_mz',
                            'aerator_d',
                            'aerator_pr',
                            'floater_kubikasi',
                            'motor_kubikasi',
                            'floater_kg',
                            'net_weight',
                            'motor_kg',];
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
