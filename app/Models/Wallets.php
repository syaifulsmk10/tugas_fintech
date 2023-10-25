<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $fillable =[
        'user_id',
        'credit',
        'debit',
        'description',
        'status'
    ];
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
