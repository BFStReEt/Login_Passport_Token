<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'username',
        'password',
        'email',
        'display_name',
        'avatar',
        'skin',
        'status',
        'phone',
        'created_at',
        'updated_at'
    ];
}