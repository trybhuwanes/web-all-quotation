<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $table = 'orders';
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'pic_id', 'uuid', 'po_path', 'attachment_path', 'status', 'discount_amount', 'discount_type', 'trx_code', 'total_price',];

    /**
     * Generate Transaction Code.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });

        static::creating(function ($model) {
            // Ambil nilai increment terakhir dari database
            $latestRecord = static::latest('id')->first();
            
            // Jika ada record sebelumnya, tambahkan increment, jika tidak mulai dari 1
            $increment = $latestRecord ? ((int) substr($latestRecord->trx_code, 0, 3)) + 1 : 1;
            
            // Format nomor urut menjadi tiga digit (misalnya 001, 002, dll.)
            $incrementFormatted = str_pad($increment, 3, '0', STR_PAD_LEFT);
            
            // Ambil bulan dan tahun saat ini
            $currentMonth = now()->format('m');
            $currentYear = now()->format('Y');
            
            // Membuat trx_code dengan format yang diinginkan
            $model->trx_code = $incrementFormatted . '-' . $currentMonth . '-EQUIP-GHI-' . $currentYear;
        });
    }


    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi ke User
    public function pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    /**
     * Relasi ke model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity')->withTimestamps();
    }

    /**
     * Relasi ke model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Detail_order::class);
    }

    /**
     * Relasi ke model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    /**
     * Relasi ke model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revisiquotation()
    {
        return $this->hasMany(Revision_quot::class);
    }
    
    /**
     * Relasi ke model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function termpayment()
    {
        return $this->hasOne(Term_payments::class);
    }

    /**
     * Relasi ke model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notecommercil()
    {
        return $this->hasOne(Notes_commercial::class);
    }
}
