<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' =>  'required',
            'slug' => ['required', 'regex:/^[a-zA-Z0-9-]+$/'],
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
