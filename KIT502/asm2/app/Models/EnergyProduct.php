<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyProduct extends Model
{
    use HasFactory;
    protected $table = 'energy_products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ownerId', 
        'energyTypeId', 
        'zoneId', 
        'volume', 
        'sellerPrice'
    ];
    public $timestamps = false;
}
