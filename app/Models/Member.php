<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'username',
        'email',
        'password',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
