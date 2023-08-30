<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        $regEx = '/^(09|08|07|05|03)[0-9]{8}$/';

        if (! preg_match($regEx, $value)) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'Phone is not correctly formatted';
    }
}
