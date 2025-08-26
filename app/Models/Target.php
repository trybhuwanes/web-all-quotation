<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $table = 'target';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pic_id', 'month', 'year', 'target'];

    public function user()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }
}
