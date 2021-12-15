<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:80',
            'price' => ['required', 'integer'],
            'upc' => ['required', 'string','unique:products','min:5'],
            'status' => 'required|in:Active,Inactive',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]; 
    }
}
