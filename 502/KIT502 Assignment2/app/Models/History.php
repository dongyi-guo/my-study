<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    // Disable timestamp from Laravel
    public $timestamps = false;
    // Add fillable property to attributes
    protected $fillable = ['userId', 'computerId', 'dateOfTime'];
    protected $table = 'history';
}
