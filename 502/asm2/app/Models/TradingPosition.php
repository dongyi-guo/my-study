<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingPosition extends Model
{
    use HasFactory;
    protected $table = 'trading_positions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title'
    ];
    public $timestamps = false;
}
