<?php

namespace App\Services;

use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\RefreshToken;
use App\Models\Admin;

use Illuminate\Support\Facades\Hash;

class AdminService implements AdminServiceInterface
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function login($request)
    {
        $val = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($val->fails()) {
            return response()->json($val->errors(), 202);
        }
        $now = date('d-m-Y H:i:s');
        $stringTime = strtotime($now);

        $admin = Admin::where('username', $request->username)->first();
        if (isset($admin) != 1) {
            return response()->json([
                'status' => false,
                'mess' => 'username'
            ]);
        }

        $check = $admin->makeVisible('password');

        if (Hash::check($request->password, $check->password)) {
            $success = $admin->createToken('Admin')->accessToken;
            $admin->lastlogin = $stringTime;
            $admin->save();

            return response()->json([
                'status' => true,
                'token' => $success,
                'username' => $admin->display_name
            ]);
        } else {
            return response()->json([
                'status' => false,
                'mess' => 'wrong pass'
            ]);
        }
    }

    public function register($request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'display_name' => 'required|string|max:250',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'display_name' => $request->display_name,
        ]);

        return redirect()->route('admin.login.form')->with('success', 'Registration successful!');
    }


    public function logout($request)
    {
        if ($token = $request->user()->token()) {
            $token->revoke(); // Thu hồi token
            return response()->json(['message' => 'Logout thành công']);
            // Thu hồi refresh tokens liên quan
            RefreshToken::where('access_token_id', $token->id)->update(['revoked' => true]);
        }
        return response()->json(['message' => 'Không tìm thấy token'], 400);
    }
}
