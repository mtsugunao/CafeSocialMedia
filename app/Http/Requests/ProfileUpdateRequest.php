<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:30'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'picture' => ['image', 'mimes:gif,png,jpg,webp', 'max:100240'],
            'favCafe' => ['string', 'nullable'],
            'favDrink' => ['string', 'nullable', 'max:30'],
            'yourself' => ['string', 'nullable', 'max:255']
        ];
    }
    public function getCafeId(): ?int {
        return $this->input('favCafe');
    }
    public function getFavDrink(): ?string {
        return $this->input('favDrink');
    }
    public function getAboutYou(): ?string {
        return $this->input('yourself');
    }
}
