<?php

namespace App\Services;

use App\Services\Interfaces\AdminServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\RefreshToken;
use App\Models\Admin;
use Carbon\Carbon;
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

            if (!$success) {
                return response()->json(['status' => false, 'mess' => 'Không thể tạo token'], 500);
            }

            $formattedDate = Carbon::createFromTimestamp($stringTime)->format('H:i:s d-m-Y ');
            $admin->lastlogin = $formattedDate;
            $admin->save();
            // session(['admin_token' => Auth::user()->id]);
            Auth::login($admin);

            return redirect()->route('admin-dashboard')->with('success', 'Đăng nhập thành công!');

            // return response()->json([
            //     'status' => true,
            //     'token' => $success,
            //     'username' => $admin->display_name
            // ]);
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
            'email' => 'required|string|email|max:255|unique:admin',
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
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin-login');
    }
}
