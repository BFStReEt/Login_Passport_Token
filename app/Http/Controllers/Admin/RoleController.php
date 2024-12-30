<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    // Hiển thị danh sách admin và vai trò của họ
    public function index()
    {
        $admins = Admin::with('roles')->get();
        $roles = Role::all();
        return view('admin.roles.index', compact('admins', 'roles'));
    }

    // Hiển thị giao diện chỉnh sửa role cho admin
    public function edit($id)
    {
        $admin = Admin::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin.roles.edit', compact('admin', 'roles'));
    }

    // Gán vai trò cho admin
    public function assignRole(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Cập nhật vai trò cho admin
        $admin->roles()->sync($request->role_ids);

        return redirect()->route('admin.roles.index')->with('success', 'Cập nhật vai trò thành công!');
    }
}
