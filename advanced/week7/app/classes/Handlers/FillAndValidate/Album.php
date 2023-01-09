<?php namespace MusicCollection\Handlers\FillAndValidate;

use MusicCollection\Databases\Objects\Genre;
use MusicCollection\Form\Data;
use MusicCollection\Form\Validation\AlbumValidator;

/**
 * Trait Album
 * @package MusicCollection\Handlers
 */
trait Album
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->album->artist_id = $this->formData->getPostVar('artist-id');
            $this->album->name = $this->formData->getPostVar('name');
            $this->album->year = $this->formData->getPostVar('year');
            $this->album->tracks = (int)$this->formData->getPostVar('tracks');
            $this->album->setGenreIds($this->formData->getPostVar('genre-ids'));

            //Actual validation
            $validator = new AlbumValidator($this->album);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
