<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Password implements Rule
{
    protected $length = 8;
    protected $requireUppercase = true;
    protected $requireNumeric = true;
    protected $requireSpecialCharacter = true;

    public function passes($attribute, $value)
    {
        $value = (string) $value;

        if ($this->requireUppercase && Str::lower($value) === $value) {
            return false;
        }

        if ($this->requireNumeric && !preg_match('/[0-9]/', $value)) {
            return false;
        }

        if ($this->requireSpecialCharacter && !preg_match('/[\W_]/', $value)) {
            return false;
        }

        return Str::length($value) >= $this->length;
    }

    public function message()
    {
        return 'The :attribute must be at least 8 characters and contain at least one uppercase letter, one number, and one special character.';
    }
}
