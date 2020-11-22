<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return [
            'required',
            'string',
            $this->passwordComplexityRule(),
            'confirmed'
        ];
    }

    protected function passwordComplexityRule(): Password
    {
        return (new Password())
            ->length(config('auth.password_min_length'));
    }
}
