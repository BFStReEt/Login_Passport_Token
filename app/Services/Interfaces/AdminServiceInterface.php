<?php

namespace App\Services\Interfaces;

interface AdminServiceInterface
{
    public function login($request);
    public function logout($request);
}