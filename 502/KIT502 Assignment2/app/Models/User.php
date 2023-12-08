<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Disable timestamp from Laravel
    public $timestamps = false;
    // Add fillable property to attributes
    protected $fillable = ['name', 'email', 'number', 'password', 'accessLevel'];
    protected $table = 'user';
}
