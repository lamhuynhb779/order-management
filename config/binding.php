<?php

return [
    'services' => [
        \App\Models\Order::class => [
            'contract' => \App\Repositories\Contracts\OrderRepository::class,
            'repository' => \App\Repositories\Eloquents\EloquentOrderRepository::class,
            'policy' => \App\Policies\Order\OrderPolicy::class,
        ],
    ],
];
