<?php

namespace App\Models;

// 1. WICHTIG: Diese Zeile importieren!
use Laravel\Sanctum\HasApiTokens; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // 2. WICHTIG: HasApiTokens hier vorne hinzufügen!
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // ... der restliche Code (inkl. deiner orders-Methode) bleibt exakt wie er ist ...
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}