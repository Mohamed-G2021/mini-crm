@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Edit Employee</h2>

    <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
            @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">New Password (leave blank if not changing)</label>
            <input name="password" type="password" class="form-control">
            @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input name="password_confirmation" type="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
