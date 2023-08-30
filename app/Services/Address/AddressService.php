<?php

namespace App\Services\Address;

use App\Repositories\Contracts\AddressRepository;

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
}
