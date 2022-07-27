<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxnLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'product_id',
        'employee_id',
        'quantity',
        'type',
        'sub_type',
        'bill_no',
        'bill_amount',
        'order_id',
        'remarks',
        'user_id',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
