<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_makanan', 'description', 'harga', 'category_id'];

    public function category()
    {
        return $this->belongsTo(JenisMakanan::class);
    }
}
