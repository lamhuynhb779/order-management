<?php

namespace App\Http\Requests\Rating;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreRatingRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'star' => 'integer|required|min:1|max:5',
            'order_id' => 'integer|required|min:1',
            'comment' => 'string|required',
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
