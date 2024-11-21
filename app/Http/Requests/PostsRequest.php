<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->creationRules();
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->updateRules();
        }

        return [];
    }

    private function creationRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'tags' => ['required', 'array'],
            'tags.*' => ['string'],
        ];
    }

    private function updateRules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'author' => ['sometimes', 'string', 'max:255'],
            'content' => ['sometimes', 'string'],
            'tags' => ['sometimes', 'array'],
            'tags.*' => ['string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'fail',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422)
        );

        parent::failedValidation($validator);
    }
}
