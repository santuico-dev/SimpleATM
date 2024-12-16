<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'accountID';

    protected $fillable = [
        'userID',
        'accountBalance'
    ];

    /**
     *
     * @return string
     */
    public function getIDAttribute()
    {
        return $this->attributes['accountID'];
    }
}
