<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('update', Category::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:4',
                'max:30',
                Rule::unique('categories')->ignore($this->category->id),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'categoria',
        ];
    }
}
