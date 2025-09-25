<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'products';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'nama_produk', 'thumbnail', 'deskripsi_produk', 'ringkasan_deskripsi', 'spesifikasi_deskripsi', 'slug', 'category_id', 'specification_type'];

    /**
     * Generate UUID Automatis.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });


        static::creating(function ($product) {
            $product->slug = self::generateSlug($product->nama_produk);
        });

        static::updating(function ($product) {
            $product->slug = self::generateSlug($product->nama_produk, $product->id);
        });
    }

    private static function generateSlug($nama_produk, $productId = null)
    {
        $slug = Str::slug($nama_produk);
        $originalSlug = $slug;
        $count = 1;

        // Cek jika slug sudah ada
        while (self::where('slug', $slug)->where('id', '!=', $productId)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoryProducts()
    {
        return $this->belongsTo(Category_product::class, 'category_id');
    }

    /**
     *.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function additionalProducts()
    {
        return $this->hasMany(Additional_product::class, 'product_id');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity')->withTimestamps();
    }


    /**
     * Relasi ke model pivot (Detail_order).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationModels()
    {
        return $this->hasMany(Product_specification_model::class);
    }

    // -----------------------------------------------------------
    // 1.specificationFas
    // 2.specificationFmp
    // 3.specificationBf
    // 4.specificationBt
    // 5.specificationDiac
    // 6.specificationWte
    /**
     * Relasi ke spesifikasi fas/Florex FAS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationFas()
    {
        return $this->hasMany(Product_specification_fas::class);
    }

    /**
     * Relasi ke spesifikasi fmp/Florex MPS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationFmp()
    {
        return $this->hasMany(Product_specification_fmp::class);
    }

    /**
     * Relasi ke spesifikasi bf/Biofax.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationBf()
    {
        return $this->hasMany(Product_specification_bf::class);
    }

    /**
     * Relasi ke spesifikasi bt/Bolted Tank.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationBt()
    {
        return $this->hasMany(Product_specification_bt::class);
    }

    /**
     * Relasi ke spesifikasi Diac.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationDiac()
    {
        return $this->hasMany(Product_specification_diac::class);
    }

    /**
     * Relasi ke spesifikasi Wte/Waste to Energy Optimazation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specificationWte()
    {
        return $this->hasMany(Product_specification_wte::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
