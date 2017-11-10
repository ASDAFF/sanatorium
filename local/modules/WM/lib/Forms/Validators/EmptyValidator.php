<?php

namespace WM\Forms\Validators;


/**
 * Class EmptyValidator
 * @package WM\Forms\Validators
 */
class EmptyValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Введите {name}';

    /**
     * Check if field is valid
     *
     * @return bool
     *
     * @access public
     */
    public function validate()
    {
        return !($this->hasError = trim($this->checkValue) === '');
    }
}