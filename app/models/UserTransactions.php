<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserTransactions extends Model
{
    protected $table = 'user_transactions';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'order_id',
        'user_id',
        'invoice_id',
        'amount',
        'status',
        'expire_date',
        'created_at',
        'updated_at'
    ];
}
