<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category_product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    

    protected $table = 'category_products';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_kategori', 'logo', 'deskripsi'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nama_ketegori' => 'string',
        'logo'          => 'string',
        'deskripsi'     => 'string',
    ];
}
