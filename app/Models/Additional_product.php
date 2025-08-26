<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Additional_product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
   protected $primaryKey = 'id';
   protected $table = 'additional_products';
   public $incrementing = true;
   protected $keyType = 'int';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = ['product_id', 'uuid', 'nama_produk_tambahan', 'thumbnail_produk_tambahan', 'deskripsi_produk_tambahan', 'harga_produk_tambahan', 'slug'];

   /**
    * Generate UUID Automatis.
    */
   protected static function boot()
   {
       parent::boot();

       static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
       });


       static::creating(function ($additionalproduct) {
            $additionalproduct->uuid = (string) Str::uuid();
            $additionalproduct->slug = $additionalproduct->generateSlug($additionalproduct->nama_produk_tambahan);
        });

        static::updating(function ($additionalproduct) {
            $additionalproduct->slug = $additionalproduct->generateSlug($additionalproduct->nama_produk_tambahan, $additionalproduct->id);
        });
   }

   private static function generateSlug($nama_produk_tambahan, $additionalproductId = null)
    {
        $slug = Str::slug($nama_produk_tambahan);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->where('id', '!=', $additionalproductId)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
