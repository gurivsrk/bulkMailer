<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorebulkMailerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from_name' => 'required',
            'from_email' => 'required|email',
            'category_name' => 'required',
            'title' => 'required',
            'newsletter' => 'required'
        ];
    }
}