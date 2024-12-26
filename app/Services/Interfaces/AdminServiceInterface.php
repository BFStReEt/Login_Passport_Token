<?php

namespace App\Services\Interfaces;

interface AdminServiceInterface
{
    public function login($_request);
    public function logout($_request);
}
