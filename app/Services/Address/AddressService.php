<?php

namespace App\Services\Address;

use App\Models\Address;
use App\Models\Order;
use App\Repositories\Contracts\AddressRepository;
use Illuminate\Support\Facades\Log;

class AddressService
{
    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function createNew(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->addressRepository->save([
            'address' => $data['address'],
            'full_address' => "{$data['address']}",
            'province_id' => $data['province_id'],
            'district_id' => $data['district_id'],
            'ward_id' => $data['ward_id'],
        ]);
    }

    /**
     * @throws \Exception
     */
    public function updateAddressByOrder(Order $order, array $data)
    {
        try {
            if (! isset($data['shipping_address']) && ! isset($data['recipient_address'])) {
                return;
            }

            if (isset($data['shipping_address'])) {
                $address = $order->shippingAddress ?? null;
                if (! $address instanceof Address) {
                    Log::error('Shipping address is not found', [
                        'order_id' => $order->id,
                    ]);

                    throw new \Exception('Shipping address is not found');
                }

                $address->update([
                    'address' => $data['shipping_address'],
                    'full_address' => $data['shipping_address'],
                ]);
            }

            if (isset($data['recipient_address'])) {
                $address = $order->recipientAddress ?? null;
                if (! $address instanceof Address) {
                    Log::error('Recipient address is not found', [
                        'order_id' => $order->id,
                    ]);

                    throw new \Exception('Recipient address is not found');
                }

                $address->update([
                    'address' => $data['recipient_address'],
                    'full_address' => $data['recipient_address'],
                ]);
            }

        } catch (\Exception $exception) {
            Log::error('Occur happen when updating address', [
                'error_message' => $exception->getMessage(),
                'error_trace' => $exception->getTraceAsString(),
                'order_id' => $order->id,
                'address_id' => $address->id,
            ]);

            throw new \Exception('Occur happen when updating address');
        }
    }
}
