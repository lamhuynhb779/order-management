<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Prepare inputs for validation.
     */
    protected function prepareForValidation(): void
    {
        if (isset($this->paginate)) {
            $this->merge(['paginate' => $this->toBoolean($this->paginate)]);
        }
    }

    /**
     * Convert to boolean
     */
    private function toBoolean(string $booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
