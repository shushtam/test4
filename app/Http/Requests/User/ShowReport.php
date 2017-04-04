<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ShowReport extends FormRequest {

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
            'role' => 'sometimes|nullable|in:' . implode(',', array_keys(\App\Models\User::getRoleList())),
            /*'role' => [
                \Illuminate\Validation\Rule::in(array_keys(\App\Models\User::getRoleList()) + ['']),
            ],*/
            'min_value' => 'sometimes|nullable|numeric',
            'max_value' => 'sometimes|nullable|numeric'
        ];
    }

}
