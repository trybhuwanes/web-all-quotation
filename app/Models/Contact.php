<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['telpon', 'mail', 'alamat', 'facebook', 'linkedin', 'youtube', 'instagram', 'tiktok'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'telpon'    => 'string',
        'mail'      => 'string',
        'alamat'    => 'string',
        'facebook'  => 'string',
        'linkedin'  => 'string',
        'youtube'   => 'string',
        'instagram' => 'string',
        'tiktok'    => 'string',
    ];
}
