<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "serial_number",
        "customer_id",
        "status",
        "user_id",
        "total_amount",
        "total_quantity",
    ];

    protected $casts = [
        'created_at' => 'datetime:d-M-y h:i A',
    ];
}
