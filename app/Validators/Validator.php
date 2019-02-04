<?php

namespace App\Validators;

class Validator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * Validate a request.
     *
     * @return boolean
     */
    public function validate(): bool
    {
        return count($this->errors) == 0;
    }

    /**
     * Get errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Add an error.
     *
     * @param string $error
     * @return void
     */
    protected function addError(string $error): void
    {
        $this->errors[] = $error;
    }
}