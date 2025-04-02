<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $customerService) {}

    public function index()
    {
        $customers = Customer::with('actions')->where('created_by', Auth::id())->latest()->get();
        return view('employee.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('employee.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->customerService->create($request->validated(), Auth::user(), Auth::id());
        return redirect()->route('employee.customers.index')->with('success', 'Customer added.');
    }

    public function edit(Customer $customer)
    {
        $this->authorizeAccess($customer);
        return view('employee.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorizeAccess($customer);
        $this->customerService->update($customer, $request->validated());
        return redirect()->route('employee.customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $this->authorizeAccess($customer);
        $this->customerService->delete($customer);
        return redirect()->route('employee.customers.index')->with('success', 'Customer deleted.');
    }

    protected function authorizeAccess(Customer $customer)
    {
        abort_if($customer->created_by !== Auth::id(), 403);
    }
}
