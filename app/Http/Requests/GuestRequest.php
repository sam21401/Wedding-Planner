<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class GuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guestId = $this->route('guest')?->id;

        return [
            'name' => 'required|unique:guests,name,' . $guestId,
            'email' => 'required',
            'surname' => 'required',
            'phone' => 'required|unique:guests,phone,' . $guestId,
        ];
    }
}
