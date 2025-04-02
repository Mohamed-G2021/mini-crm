<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
        ]);

        return redirect()->route('admin.employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit($id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);

        $employee->name = $request->name;
        $employee->email = $request->email;

        if ($request->filled('password')) {
            $employee->password = bcrypt($request->password);
        }

        $employee->save();

        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        $employee = User::where('role', 'employee')->findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully.');
    }
}
