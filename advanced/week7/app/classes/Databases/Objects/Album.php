<?php namespace MusicCollection\Databases\Objects;

use MusicCollection\Databases\BaseObject;
use MusicCollection\Databases\Database;

/**
 * Class Album
 * @package MusicCollection\Databases\Objects
 * @method static Album[] getAll()
 * @method static Album getById($id)
 */
class Album extends BaseObject
{
    protected static string $table = 'albums';
    protected static array $joinForeignKeys = [
        'artist_id' => [
            'table' => 'artists',
            'object' => 'MusicCollection\Databases\Objects\Artist'
        ],
        'user_id' => [
            'table' => 'users',
            'object' => 'MusicCollection\Databases\Objects\User'
        ]
    ];

    public ?int $id = null;
    public ?int $user_id = null;
    public ?int $artist_id = null;
    public string $name = '';
    public string $year = '';
    public int $tracks = 0;
    public string $image = '';
    private array $genreIds = [];

    /**
     * @return bool
     */
    public function saveGenres(): bool
    {
        try {
            $this->db->beginTransaction();

            //Delete all current references
            $statement = $this->db->prepare('DELETE FROM album_genre WHERE album_id = :album_id');
            $statement->execute([':album_id' => $this->id]);

            //Add the current references
            foreach ($this->genreIds as $genreId) {
                $statement = $this->db->prepare('INSERT INTO album_genre (genre_id, album_id) VALUES (:genre_id, :album_id)');
                $statement->execute([
                    ':genre_id' => $genreId,
                    ':album_id' => $this->id
                ]);
            }
            $this->db->commit();
            return true;
        } catch (\PDOException) {
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * @return Genre[]
     */
    public function getGenres(): array
    {
        $statement = $this->db->prepare(
            'SELECT g.* FROM genres AS g
                    LEFT JOIN album_genre ag ON g.id = ag.genre_id
                    LEFT JOIN albums a on ag.album_id = a.id
                    WHERE a.id = :album_id'
        );
        $statement->execute([':album_id' => $this->id]);

        return $statement->fetchAll(\PDO::FETCH_CLASS, '\\MusicCollection\\Databases\\Objects\\Genre');
    }

    /**
     * @return array
     */
    public function getGenreIds(): array
    {
        return $this->genreIds;
    }

    /**
     * @param array $genreIds
     * @return void
     */
    public function setGenreIds(array $genreIds): void
    {
        $this->genreIds = $genreIds;
    }
}
