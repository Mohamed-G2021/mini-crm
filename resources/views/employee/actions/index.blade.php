@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Action History for: {{ $customer->name }}</h2>
    <a href="{{ route('employee.customers.index') }}" class="btn btn-sm btn-secondary mb-3">← Back</a>

    @if($actions->isEmpty())
        <div class="alert alert-info">No actions recorded yet.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th><th>Date</th><th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actions as $action)
                    <tr>
                        <td>{{ ucfirst($action->type) }}</td>
                        <td>{{ $action->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $action->result }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
