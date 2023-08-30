<?php

namespace App\Helpers\Order;

use App\Models\Order;

class OrderHelper
{
    /**
     * @throws \Exception
     */
    public static function generateOrderNumber(): int
    {
        do {
            $code = random_int(1000000, 9999999);
        } while (Order::where('code', '=', $code)->first());

        return $code;
    }
}
