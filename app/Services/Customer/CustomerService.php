<?php

namespace App\Services\Customer;

use App\Repositories\Contracts\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function createNew(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->customerRepository->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
}
