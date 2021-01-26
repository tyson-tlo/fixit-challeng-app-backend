<?php

namespace App\Http\Requests\Clients\Jobs\Images;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientJobImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('job')->user_id == $this->user()->id || $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|mimes:png,jpg,jpeg|max:5000',
            'description' => 'nullable'
        ];
    }
}
