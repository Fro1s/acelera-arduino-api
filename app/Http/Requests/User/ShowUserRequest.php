<?php

namespace App\Http\Requests\User;

use App\Helper\User\IdUserRuleHelper;
use App\Traits\BasicFormRequestValidation;
use Illuminate\Foundation\Http\FormRequest;

class ShowUserRequest extends FormRequest
{
    use BasicFormRequestValidation;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => IdUserRuleHelper::rule()
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['id'=> $this->route('id')]);
    }
}
