<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
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

        throw new ValidationException($validator, $this->sendCustomResponse(false, StatusCode::BAD_REQUEST->value, 'Request param is invalid', ErrorCode::REQUEST_PARAMS_INVALID->value));
    }
}
