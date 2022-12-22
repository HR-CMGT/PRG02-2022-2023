<?php namespace MusicCollection\Databases\Objects;

use MusicCollection\Databases\BaseObject;

/**
 * Class Genre
 * @package MusicCollection\Databases\Objects
 * @method static Genre[] getAll()
 * @method static Genre getById(int $id)
 */
class Genre extends BaseObject
{
    protected static string $table = 'genres';

    public ?int $id = null;
    public string $name = '';

    /**
     * As Genre is used on many-to-many related scenarios, we need a simple string when printing the object
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}
