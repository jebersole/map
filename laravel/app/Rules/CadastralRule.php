<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CadastralRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(\d{2}:\d{2}:\d{7}:\d{4},*\s*)+$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Неверный формат для кадастрового номера.';
    }
}
