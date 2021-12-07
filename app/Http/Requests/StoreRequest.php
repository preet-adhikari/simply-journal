<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required'
        ];
    }

//    public function withValidator($validator){
//        // Validation works
//        if (!$validator->fails()){
//            return "200";
//        } else {
//            return "400";
//        }
//    }

    //Custom messages for validation
    public function messages(): array
    {
        return [
          'title.required' => 'The Post title is required.',
          'body.required' => 'The Post body is required.'
        ];
    }
}
