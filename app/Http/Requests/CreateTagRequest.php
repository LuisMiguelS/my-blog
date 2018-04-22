<?php

namespace App\Http\Requests;

use App\Tag;
use Illuminate\Foundation\Http\FormRequest;

class CreateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('create', Tag::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag' => 'required|min:3|max:20|unique:tags'
        ];
    }

    public function attributes()
    {
        return [
            'tag' => 'etiqueta'
        ];
    }
}
