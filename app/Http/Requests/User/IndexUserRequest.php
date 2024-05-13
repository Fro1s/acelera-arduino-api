<?php

namespace App\Http\Requests\User;

use App\Helper\Paginate\PageRuleHelper;
use App\Helper\Paginate\PerPageRuleHelper;
use App\Traits\BasicFormRequestValidation;
use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
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
            ...PageRuleHelper::rule(),
            ...PerPageRuleHelper::rule()
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['per_page' => $this->input('per_page', 10), 'page' => $this->input('page', 1)]);
    }
}
