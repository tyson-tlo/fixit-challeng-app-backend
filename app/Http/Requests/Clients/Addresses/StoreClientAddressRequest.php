<?php

namespace App\Http\Requests\Clients\Addresses;

use App\Models\ClientAddress;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin() || $this->user()->id === $this->user_id;
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
                'required',
                function ($attribute, $value, $fail) {
                    $hasRecord = ClientAddress::where(['user_id' => $this->user_id, 'address_1' => $this->address_1])->count();

                    if ($hasRecord) {
                        $fail('You have already stored this address');
                    }
                }
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
