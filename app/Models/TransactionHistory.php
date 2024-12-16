<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $table = 'transaction_history';
    protected $primaryKey = 'transactionID';

    protected $fillable = [
        'accountID',
        'transactionType',
        'amount',
        'transactionDate'
    ];

    /**
     *
     * @return string
     */
    public function getIDAttribute()
    {
        return $this->attributes['transactionID'];
    }
}
