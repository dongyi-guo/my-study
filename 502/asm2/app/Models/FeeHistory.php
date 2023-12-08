<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHistory extends Model
{
    use HasFactory;
    protected $table = "fee_history";
    protected $primaryKey = "id";
    protected $fillable = [
        'feeDateTime',
        'managerId',
        'marketFee',
        'adminFee',
        'taxRate'
    ];
    public $timestamps = false;
}
