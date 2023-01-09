<?php namespace MusicCollection\Form\Validation;

use MusicCollection\Databases\Objects\Album;

/**
 * Class AlbumValidator
 * @package MusicCollection\Form\Validation
 */
class AlbumValidator implements Validator
{
    private array $errors = [];

    /**
     * AlbumValidator constructor.
     *
     * @param Album $album
     */
    public function __construct(private readonly Album $album)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->album->artist_id == '') {
            $this->errors[] = 'Artist cannot be empty';
        }
        if ($this->album->name == '') {
            $this->errors[] = 'Album cannot be empty';
        }
        if (empty($this->album->getGenreIds())) {
            $this->errors[] = 'You need to choose at least 1 genre';
        }
        if ($this->album->year == '') {
            $this->errors[] = 'Year cannot be empty';
        }
        if (!is_numeric($this->album->year) || strlen($this->album->year) != 4) {
            $this->errors[] = 'Year needs to be a number with the length of 4';
        }
        if ($this->album->tracks == '') {
            $this->errors[] = 'Tracks cannot be empty';
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
