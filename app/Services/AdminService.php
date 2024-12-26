<?php

namespace App\Services;

use App\Services\Interfaces\AdminServiceInterface;
use Dotenv\Validator;

class AdminService implements AdminServiceInterface
{
    public function login($request) {
        $val = Validator::make($request->all),[
            
        ]
    }
}
