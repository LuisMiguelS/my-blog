<?php

namespace App\Http\Requests;

use App\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('update', Tag::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag' => [
                'required',
                'min:4',
                'max:20',
                Rule::unique('tags')->ignore($this->route('tag')->id),
            ],
        ];
    }

    public function attributes()
    {
        return [
            'tag' => 'etiqueta',
        ];
    }
}
