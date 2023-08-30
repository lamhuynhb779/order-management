<?php

namespace App\Services\Order;

use App\Helpers\Order\OrderHelper;
use App\Repositories\Contracts\OrderRepository;
use App\Services\Address\AddressService;
use App\Services\Customer\CustomerService;

class OrderService
{
    protected $orderRepository;

    protected $customerService;

    protected $addressService;

    public function __construct(
        OrderRepository $orderRepository,
        CustomerService $customerService,
        AddressService $addressService
    ) {
        $this->orderRepository = $orderRepository;
        $this->customerService = $customerService;
        $this->addressService = $addressService;
    }

    /**
     * @throws \Exception
     */
    public function createNew(array $data): \Illuminate\Database\Eloquent\Model
    {
        $customer = $this->customerService->createNew([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        $shippingAddress = $this->addressService->createNew([
            'address' => $data['shipping_address'],
            'province_id' => 1,
            'district_id' => 1,
            'ward_id' => 1,
        ]);

        $recipientAddress = $this->addressService->createNew([
            'address' => $data['recipient_address'],
            'province_id' => 2,
            'district_id' => 2,
            'ward_id' => 2,
        ]);

        return $this->orderRepository->save([
            'code' => OrderHelper::generateOrderNumber(),
            'customer_id' => $customer->id,
            'recipient_address_id' => $recipientAddress->id,
            'shipping_address_id' => $shippingAddress->id,
            'shipping_date' => $data['shipping_date'],
            'expected_delivery_date' => $data['expected_delivery_date'],
        ]);
    }
}
