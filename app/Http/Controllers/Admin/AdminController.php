<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Laravel\Passport\RefreshToken;
use App\Services\Interfaces\AdminServiceInterface as AdminService;
use Exception;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function login(Request $request)
    {
        try {
            $login = $this->adminService->login($request);
            return $login;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'mess' => $e->getMessage()
            ], 422);
        }
    }

    public function register(Request $request)
    {
        try {
            $register = $this->adminService->register($request);
            return $register;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'mess' => $e->getMessage()
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            $logout = $this->adminService->logout($request);
            return $logout;
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
