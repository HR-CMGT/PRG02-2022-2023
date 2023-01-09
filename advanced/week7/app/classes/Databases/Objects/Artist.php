<?php namespace MusicCollection\Databases\Objects;

use MusicCollection\Databases\BaseObject;

/**
 * Class Artist
 * @package MusicCollection\Databases\Objects
 * @method static Artist[] getAll()
 * @method static Artist getById(int $id)
 */
class Artist extends BaseObject
{
    protected static string $table = 'artists';
    protected static array $joinForeignKeys = [
        'user_id' => [
            'table' => 'users',
            'object' => 'MusicCollection\Databases\Objects\User'
        ]
    ];

    public ?int $id = null;
    public ?int $user_id = null;
    public string $name = '';

    /**
     * @return Album[]
     */
    public function albums(): array
    {
        $statement = $this->db->prepare(
            "SELECT al.* FROM `albums` AS al
                    LEFT JOIN artists ar ON ar.id = al.artist_id
                    WHERE `ar`.`id` = :id"
        );
        $statement->execute([':id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, 'MusicCollection\Databases\Objects\Album');
    }
}
