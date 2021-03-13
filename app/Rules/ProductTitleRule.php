<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ProductTitleRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[а-я0-9\s]+$/msiu', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'В title разрешены только кириллица, цифры и пробел.';
    }
}
