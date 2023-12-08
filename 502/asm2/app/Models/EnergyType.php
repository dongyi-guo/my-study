<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyType extends Model
{
    use HasFactory;
    protected $table = 'energy_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'typeName'
    ];
    public $timestamps = false;
}
