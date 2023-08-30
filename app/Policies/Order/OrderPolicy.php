<?php

namespace App\Policies\Order;

class OrderPolicy
{
    public function create(): bool
    {
        return true;
    }
}
