<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function firstOrCreate(array $search, array $data): Customer
    {
        return Customer::firstOrCreate($search, $data);
    }
}