<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NullStringRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == "null") {
            if ($attribute == "title") {
                $fail("Judul tidak boleh kosong!");
            }

            if ($attribute == "body") {
                $fail("Isi artikel tidak boleh kosong!");
            }

        }
    }
}
