<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyTransaction extends Model
{
    use HasFactory;
    protected $table = 'energy_transactions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'feeId',
        'buyerId',
        'sellerId',
        'energyTypeId',
        'zoneId',
        'transactionDateTime',
        'volume',
        'tax',
        'tradingPrice',
        'sellerReceivedPrice'
    ];
    public $timestamps = false;
}
