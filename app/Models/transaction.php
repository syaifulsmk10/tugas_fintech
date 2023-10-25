<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
   protected $fillable = [
          'user_id',
    'product_id',
    'status',
    'order_id',
    'quantity',
    'price',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}