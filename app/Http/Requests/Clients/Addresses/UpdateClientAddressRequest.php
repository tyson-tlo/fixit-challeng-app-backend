<?php

namespace App\Http\Requests\Clients\Addresses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('address')->userCanView($this->user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'address_1' => [
                'required'
            ],
            'address_2' => 'nullable',
            'city' => 'required',
            'province' => 'required',
            'country' => 'nullable',
            'is_primary' => 'boolean|nullable',
            'notes' => 'nullable'
        ];
    }
}
