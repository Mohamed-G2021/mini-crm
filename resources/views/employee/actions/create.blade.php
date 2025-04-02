@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Add Action for: {{ $customer->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('employee.actions.store') }}">
        @csrf
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

        <div class="mb-3">
            <label class="form-label">Action Type</label>
            <select name="type" class="form-select" required>
                <option value="call">Call</option>
                <option value="visit">Visit</option>
                <option value="follow_up">Follow Up</option>
            </select>
            @error('type') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Result</label>
            <textarea name="result" rows="4" class="form-control" required>{{ old('result') }}</textarea>
            @error('result') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Save Action</button>
    </form>
</div>
@endsection
