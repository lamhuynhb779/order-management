<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use App\Rules\PhoneRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StoreOrderRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:50',
            'phone' => ['required', new PhoneRule()],
            'email' => 'email|nullable',
            'shipping_address' => 'string|required|max:100',
            'recipient_address' => 'string|required|max:100',
            'shipping_date' => 'date|required',
            'expected_delivery_date' => 'date|required',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('type')) {
            if (empty($this->type)) {
                $this->query->remove('type');
            } else {
                $this->merge([
                    'type' => $this->type,
                ]);
            }
        }
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
