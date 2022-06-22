<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|max:120',
            'role' => 'in:' .User::ADMIN_ROLE. ',' . User::AUTHOR_ROLE. ',' .User::READER_ROLE,
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ],
        ];
    }
}
