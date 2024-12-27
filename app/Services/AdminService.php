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
        $val = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'display_name' => 'required|string|max:250',
        ]);

        if ($val->fails()) {
            return response()->json($val->errors(), 422);
        }

        $admin = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'display_name' => $request->display_name,
        ]);

        return response()->json(['status' => true, 'message' => 'Đăng ký thành công']);
    }



    public function logout($request)
    {
        $token = $request->user()->token();
        if ($token) {
            $token->revoke();
            RefreshToken::where('access_token_id', $token->id)->update(['revoked' => true]);
            return response()->json(['message' => 'Đăng xuất thành công']);
        }
        return response()->json(['message' => 'Không tìm thấy token'], 400);
    }
}
