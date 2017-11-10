<?php

namespace WM\Forms\Validators;


/**
 * Class EmailValidator
 * @package WM\Forms\Validators
 */
class EmailValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Неверный формат E-mail';

    /**
     * Check if field is valid
     *
     * @return bool
     *
     * @access public
     */
    public function validate()
    {
        return !($this->hasError = !filter_var($this->checkValue, FILTER_VALIDATE_EMAIL));
    }
}