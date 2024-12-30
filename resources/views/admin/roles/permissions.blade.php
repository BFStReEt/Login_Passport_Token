@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Quản lý quyền</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên vai trò</th>
                <th>Quyền hiện tại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    {{ $role->permissions->pluck('name')->join(', ') }}
                </td>
                <td>
                    <a href="{{ route('admin-roles-editPermissions', $role->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection