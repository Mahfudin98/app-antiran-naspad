<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'kategori_id',
        'nama',
        'harga',
        'status',
        'gambar',
    ];

    public function products()
    {
        return $this->hasMany(Pesanan::class, 'product_id', 'id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
