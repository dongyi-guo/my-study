<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    // Disable timestamp from Laravel
    public $timestamps = false;
    // Add fillable property to attributes
    protected $fillable = [
        'userId', 'image', 'brand', 'price', 'isRented', 'isDamaged',
        'hasInsurance', 'system', 'display', 'ram', 'usbCount', 'hdmi'
    ];
    protected $table = 'computer';
}
