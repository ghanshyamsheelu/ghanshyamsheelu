<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerData extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $table = 'customer_data';
    protected $fillable = [
        'date',
        'particular',
        'debit',
        'credit',
        'amount',
        'customer_id',
        'updated_at',
        'deleted_at',
    ];
}
