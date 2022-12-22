<?php namespace MusicCollection\Form\Validation;

/**
 * Interface Validator
 * @package MusicCollection\Form\Validation
 */
interface Validator
{
    /**
     * Validate magic
     */
    public function validate(): void;

    /**
     * @return array
     */
    public function getErrors(): array;
}
