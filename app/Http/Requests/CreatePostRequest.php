<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('create', Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'title' => 'required|min:20|max:255',
            'seo_title' => 'nullable|min:20',
            'body' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:5120',
            'status' => 'in:' .Post::PUBLISHED. ',' .Post::DRAFT. ',' .Post::PENDING,
            'excerpt' => 'required|min:20',
            'meta_description' => 'nullable|min:15',
            'meta_keywords' => 'nullable|min:10',
        ];
    }
}
