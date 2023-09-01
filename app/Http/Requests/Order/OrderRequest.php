<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class OrderRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'search' => 'array',
            'search.*' => 'array',
            'search.*.field' => 'string',
            'search.*.value' => 'present|required_with:search.*.field',
            'filter.shipping_date' => 'date',
            'paginate' => 'bool',
            'limit' => 'numeric',
            'sort' => 'string',
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
