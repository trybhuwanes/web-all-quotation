<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_specification_model extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'product_specification_models';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id',
                            'harga',
                            'model_name',
                            'hp',
                            'kw',
                            'sotr',
                            'md',
                            'mz',
                            'd',
                            'pr',
                            'dry_solids_min',
                            'dry_solids_max',
                            'dimension_l',
                            'dimension_w',
                            'dimension_h',
                            'power',
                            'opex_chemical_min',
                            'opex_chemical_max',
                            'opex_electrical_min',
                            'opex_electrical_max',];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
