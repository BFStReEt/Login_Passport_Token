@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Chỉnh sửa vai trò: {{ $admin->username }}</h2>
    <form action="{{ route('admin-roles-assign', $admin->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="roles">Chọn vai trò:</label>
            <select name="role_ids[]" id="roles" class="form-control" multiple>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                    {{ $admin->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection