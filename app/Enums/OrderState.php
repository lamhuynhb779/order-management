<?php

namespace App\Enums;

class OrderState
{
    const CREATING = 1;

    const WAITING_CONFIRM = 2;

    const CONFIRMED = 3;

    const SHIPPING = 4;

    const ARRIVED = 5;

    const DELIVERED = 6;

    const CANCELLED = 7;

    public static function getStateNameById(int $stateId): string
    {
        if ($stateId === self::CREATING) {
            return 'Created';
        }
        if ($stateId === self::WAITING_CONFIRM) {
            return 'Waiting confirm';
        }
        if ($stateId === self::CONFIRMED) {
            return 'Confirmed';
        }
        if ($stateId === self::SHIPPING) {
            return 'Shipping';
        }
        if ($stateId === self::ARRIVED) {
            return 'Arrived';
        }
        if ($stateId === self::DELIVERED) {
            return 'Delivered';
        }
        if ($stateId === self::CANCELLED) {
            return 'Cancelled';
        }

        return 'Unknown';
    }
}
