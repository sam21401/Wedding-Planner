<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     required={"name", "email", "surname", "phone"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Guest's first name",
 *         example="John"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Guest's email address",
 *         example="john.doe@example.com"
 *     ),
 *     @OA\Property(
 *         property="surname",
 *         type="string",
 *         description="Guest's surname",
 *         example="Doe"
 *     ),
 *     @OA\Property(
 *         property="phone",
 *         type="string",
 *         description="Guest's phone number",
 *         example="+1234567890"
 *     )
 * )
 */
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
