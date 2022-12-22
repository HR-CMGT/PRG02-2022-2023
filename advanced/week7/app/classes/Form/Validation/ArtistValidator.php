<?php namespace MusicCollection\Form\Validation;

use MusicCollection\Databases\Objects\Artist;

/**
 * Class ArtistValidator
 * @package MusicCollection\Form\Validation
 */
class ArtistValidator implements Validator
{
    private array $errors = [];

    /**
     * ArtistValidator constructor.
     *
     * @param Artist $artist
     */
    public function __construct(private readonly Artist $artist)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->artist->name == '') {
            $this->errors[] = 'Artist name cannot be empty';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
