<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use App\Rules\PhoneRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class UpdateOrderRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|max:50',
            'phone' => new PhoneRule(),
            'email' => 'email|nullable',
            'shipping_address' => 'string|max:100',
            'recipient_address' => 'string|max:100',
            'shipping_date' => 'date',
            'expected_delivery_date' => 'date',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        //
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        Log::info(__CLASS__.' - Banners request: '.$errors);

        throw new ValidationException(
            $validator,
            response()->json((['status' => 400, 'invalid_fields' => $errors]), 400)
        );
    }
}
