<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Models\Order;
use App\Repositories\Contracts\CustomerRepository;
use Illuminate\Support\Facades\Log;

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

    /**
     * @throws \Exception
     */
    public function updateCustomerByOrder(Order $order, array $data)
    {
        try {
            $customerData = collect();
            if (isset($data['name'])) {
                $customerData->put('name', $data['name']);
            }
            if (isset($data['phone'])) {
                $customerData->put('phone', $data['phone']);
            }
            if (isset($data['email'])) {
                $customerData->put('email', $data['email']);
            }

            if (! $customerData->isEmpty()) {
                $customer = $order->customer;
                if (! $customer instanceof Customer) {
                    Log::error('Customer is not found', [
                        'order_id' => $order->id,
                    ]);

                    throw new \Exception('Customer is not found');
                }

                $customer->update($customerData->all());
            }

        } catch (\Exception $exception) {
            Log::error('Occur happen when updating customer', [
                'error_message' => $exception->getMessage(),
                'error_trace' => $exception->getTraceAsString(),
                'order_id' => $order->id,
                'customer_id' => $customer->id,
            ]);

            throw new \Exception('Occur happen when updating customer');
        }
    }
}
