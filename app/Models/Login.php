<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Login extends  Authenticatable
{
        use HasFactory;
        protected $table = 'logins';
    //

    protected $fillable = [
        'username',
        'password',
    ];
    // public function Username()
    // {
    //     return 'username'
    // }
}
