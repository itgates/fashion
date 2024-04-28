<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        if($this->isMethod('PUT')){
            return [
                'name'=>['nullable','unique:products,name'],
                'category_id'=>['nullable','exists:categories,id'],
                'sub_category_id'=>['nullable','exists:sub_categories,id'],
                'description'=>['nullable'],
                'image'=>['nullable','string'],
            ];
        }

        if ($this->isMethod('POST')){
            return [
                'name'=>['required','unique:products,name'],
                'category_id'=>['required','exists:categories,id'],
                'sub_category_id'=>['required','exists:sub_categories,id'],
                'description'=>['required'],
                'image'=>['required','string'],
            ];
        }

        return [];

    }


}
