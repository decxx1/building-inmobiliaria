<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        //
        $endpoint = config('services.google_recaptcha');

        $response = Http::asForm()->post($endpoint['url'], [
            'secret' => $endpoint['secret_key'],
            'response' => $value,
        ])->json();

        if(  $response['success'] && $response['score'] > 0.5) {
            return true;
        }

        return false;


    }

    public function message()
    {
        return 'Recaptcha';
    }
}
