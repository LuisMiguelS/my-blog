<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->profile->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'mimes:jpeg,jpg,png,gif,svg|max:5120',
            'about' => 'required|min:20',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instragram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'google_plus' => 'nullable|url'
        ];
    }
}
