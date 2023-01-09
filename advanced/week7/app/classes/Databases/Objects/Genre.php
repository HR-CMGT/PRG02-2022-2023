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

    /**
     * @return Album[]
     */
    public function albums(): array
    {
        $statement = $this->db->prepare(
            "SELECT al.* FROM `albums` AS al
                    LEFT JOIN album_genre ag ON al.id = ag.album_id
                    LEFT JOIN genres g on ag.genre_id = g.id
                    WHERE `g`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'MusicCollection\Databases\Objects\Album');
    }
}
