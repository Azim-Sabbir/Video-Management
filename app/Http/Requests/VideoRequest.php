<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'duration' => 'required|string|max:50',
            'url' => 'required|string|url|unique:videos,url|max:800',
            'thumbnail' => 'required|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'sometimes|string|max:100',
        ];
    }
}
