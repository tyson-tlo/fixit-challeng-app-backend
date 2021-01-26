<?php

namespace App\Http\Requests\Clients\Jobs;

use App\Models\ClientAddress;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user_id == $this->user()->id || $this->user()->isAdmin();
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
            'client_address_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $client_address = ClientAddress::where('user_id', $this->user_id)->where('id', $this->client_address_id)->count();

                    if (!$client_address) {
                        $fail("The address doesn't appear to belong to the authenticated user");
                    }
                }
            ],
            'details' => 'required',
            'status' => 'nullable',
            'scheduled' => 'required',
            'todos' => 'nullable',
            'service_id' => 'required'
        ];
    }
}
