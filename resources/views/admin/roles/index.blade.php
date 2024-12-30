@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Quản lý phân quyền</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên tài khoản</th>
                <th>Vai trò</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->username }}</td>
                <td>
                    {{ $admin->roles->pluck('name')->join(', ') }}
                </td>
                <td>
                    <a href="{{ route('admin-roles-edit', $admin->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection