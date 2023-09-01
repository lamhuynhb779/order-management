<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class UpdateOrderStateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'state_id' => 'integer|required|min:1|max:7',
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
        throw new ValidationException(
            $validator,
            response()->json((['status' => 400, 'invalid_fields' => $validator->errors()]), 400)
        );
    }
}
