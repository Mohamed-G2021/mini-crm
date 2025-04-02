<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $customerService) {}

    public function index()
    {
        $customers = Customer::with('assignedEmployee')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.customers.create', compact('employees'));
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->create($request->validated(), auth()->user(), $request->assigned_to);
        return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $employees = User::where('role', 'employee')->get();
        return view('admin.customers.edit', compact('customer', 'employees'));
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $this->customerService->update($customer, $request->validated(), $request->assigned_to);
        return redirect()->route('admin.customers.index')->with('success', 'Customer updated.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customerService->delete($customer);

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted.');
    }}
