<?php namespace MusicCollection\Handlers\FillAndValidate;

use MusicCollection\Form\Data;
use MusicCollection\Form\Validation\GenreValidator;

/**
 * Trait Genre
 * @package MusicCollection\Handlers
 */
trait Genre
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->genre->name = $this->formData->getPostVar('name');

            //Actual validation
            $validator = new GenreValidator($this->genre);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
