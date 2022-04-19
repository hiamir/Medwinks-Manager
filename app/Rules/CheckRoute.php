<?php

namespace App\Rules;

use App\Traits\Quicker;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Route;

class CheckRoute implements Rule
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
        if (Route::has($value)) {
           return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The route does not exists.';
    }
}
