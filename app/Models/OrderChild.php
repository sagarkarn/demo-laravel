<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChild extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];
}
