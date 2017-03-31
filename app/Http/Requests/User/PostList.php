<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PostList extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            'email' => 'sometimes|nullable|email',
            'role' => 'in:' . implode(',', array_keys(\App\Models\User::getRoleList())),
        ];
    }

    public function messages() {
        return [
            'email.regex' => 'email must contain @',
            'name.regex' => 'name must contain only letters',
        ];
    }

}
