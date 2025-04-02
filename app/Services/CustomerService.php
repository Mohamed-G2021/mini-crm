<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\User;

class CustomerService
{
    public function create(array $data, User $creator, ?int $assignedTo = null): Customer
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'created_by' => $creator->id,
            'assigned_to' => $assignedTo ?? null,
        ]);
    }

    public function update(Customer $customer, array $data, ?int $assignedTo = null): Customer
    {
        $customer->update([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'assigned_to' => $assignedTo ?? $customer->assigned_to,
        ]);

        return $customer;
    }

    public function delete(Customer $customer): void
    {
        $customer->delete();
    }
}
