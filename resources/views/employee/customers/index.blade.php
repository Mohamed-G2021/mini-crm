@extends('layouts.app')
@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <h2>My Customers</h2>
        <a href="{{ route('employee.customers.create') }}" class="btn btn-primary">Add Customer</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Last Action</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>
                    @php $lastAction = $customer->actions()->latest()->first(); @endphp
                    @if($lastAction)
                        <div class="text-muted small">
                            <strong>{{ ucfirst($lastAction->type) }}</strong> -
                            {{ $lastAction->created_at->format('Y-m-d') }}<br>
                            {{ Str::limit($lastAction->result, 40) }}
                        </div>
                    @else
                        <div class="text-muted small">No actions yet</div>
                    @endif
                </td>
                <td>{{ $customer->created_at }}</td>
                <td>{{ $customer->updated_at }}</td>
                <td>
                    <a href="{{ route('employee.actions.index', $customer->id) }}" class="btn btn-sm btn-info">View Actions</a>
                    <a href="{{ route('employee.actions.create', $customer->id) }}" class="btn btn-sm btn-info">Add Action</a>
                    <a href="{{ route('employee.customers.edit', $customer->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form method="POST" action="{{ route('employee.customers.destroy', $customer->id) }}" style="display:inline;" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
