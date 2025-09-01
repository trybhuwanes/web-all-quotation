<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_specification_fmp extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'product_specification_fmp';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id',
                            'type_name',
                            'harga',
                            'dry_solids_min',
                            'dry_solids_max',
                            'dimension_l',
                            'dimension_w',
                            'dimension_h',
                            'net_weight',
                            'power_kw',
                            'opex_chemical_min',
                            'opex_chemical_max',
                            'opex_electrical_min',
                            'opex_electrical_max',

                            'quot_pd_flush_water',
                            'quot_sc_specification_length',
                            'quot_sc_quantity',
                            'quot_sc_motorpower',
                            'quot_fmt_dimension',
                            'quot_fmt_volume',
                            'quot_fmt_motorpower',
                            'quot_equipment_weight',
                            'quot_operating_weight',
                            'quot_work_time',

                            'floater_kubikasi',
                            'motor_kubikasi',
                            'floater_kg',
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
