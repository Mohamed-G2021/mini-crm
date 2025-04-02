<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActionRequest;
use App\Models\Action;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    public function index(Customer $customer)
    {
        abort_if($customer->assigned_to !== auth()->id(), 403);
        $actions = $customer->actions()->latest()->get();
        return view('employee.actions.index', compact('customer', 'actions'));
    }
    
    public function create(Customer $customer)
    {
        abort_if($customer->assigned_to !== Auth::id(), 403);
        return view('employee.actions.create', compact('customer'));
    }

    public function store(StoreActionRequest $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        abort_if($customer->assigned_to !== auth()->id(), 403);

        Action::create([
            'customer_id' => $request->customer_id,
            'employee_id' => auth()->id(),
            'type' => $request->type,
            'result' => $request->result,
        ]);

        return redirect()->route('employee.customers.index')->with('success', 'Action logged successfully.');
    }
}
