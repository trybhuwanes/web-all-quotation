<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'shipping';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'use_shipping_to_onsite', 'type_transportation', 'weight_kg', 'volume_m3', 'shipping_cost', 'company_destination', 'state_destination', 'country_destination', 'district_destination', 'address_destination'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
