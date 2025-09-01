<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'carts';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id' ];

    /**
     * Generate Transaction Code.
     */
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->trx_code = 'GHI-' . strtoupper(Str::random(4)) . '-' . now()->format('YmdHis');
    //     });
    // }

    // /**
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // /**
    //  * Relasi ke model pivot (Detail_order).
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withPivot('quantity')->withTimestamps();
    // }


    /**
     * Relasi ke model pivot (Detail_order).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Detail_cart::class);
    }
}
