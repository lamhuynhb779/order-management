<?php

return [
    'services' => [
        \App\Models\Order::class => [
            'contract' => \App\Repositories\Contracts\OrderRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentOrderRepository::class,
            'policy' => \App\Policies\Order\OrderPolicy::class,
        ],
        \App\Models\Customer::class => [
            'contract' => \App\Repositories\Contracts\CustomerRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentCustomerRepository::class,
            'policy' => '',
        ],
        \App\Models\Address::class => [
            'contract' => \App\Repositories\Contracts\AddressRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentAddressRepository::class,
            'policy' => '',
        ],
        \App\Models\State::class => [
            'contract' => \App\Repositories\Contracts\StateRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentStateRepository::class,
            'policy' => '',
        ],
        \App\Models\Rating::class => [
            'contract' => \App\Repositories\Contracts\RatingRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentRatingRepository::class,
            'policy' => '',
        ],
    ],
];
