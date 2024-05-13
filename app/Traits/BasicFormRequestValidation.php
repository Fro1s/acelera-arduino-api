<?php

namespace App\Traits;

use App\Builder\ReturnApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

trait BasicFormRequestValidation
{
    public function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, ReturnApi::error($validator->errors()->first(), $validator->errors()->toArray()));
    }
}