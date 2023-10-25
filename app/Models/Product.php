<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [
        'name',
        'price',
        'stock',
        'photo',
        'description',
        'categories_id',
        'stand',
    ];
}
