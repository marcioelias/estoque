<?php

namespace App\Rules;

use App\Estoque;
use Illuminate\Contracts\Validation\Rule;

class ValidInventarioItem implements Rule
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
        return (Estoque::find($value)->produtos->count() > 0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Não existem produtos relacionados a este estoque.';
    }
}
