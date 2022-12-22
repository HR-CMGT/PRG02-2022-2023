<?php /** @noinspection SqlResolve */

namespace MusicCollection\Databases;

use MusicCollection\Utils\Logger;

/**
 * Class BaseObject
 * @package MusicCollection\Databases
 * @property null|int $id
 *
 * @example To extend this class use the following format with nullable ID and empty default values
 *  class MyObject extends BaseObject
 *  {
 *      protected static string $table = '<name_of_table>';
 *      protected static array $joinForeignKeys = [];
 *
 *      public ?int $id = null;
 *      public string $name = "";
 *  }
 */
abstract class BaseObject
{
    protected static string $table = '';
    protected static array $joinForeignKeys = [];
    private string $tableName;
    protected \PDO $db;
    private Logger $logger;

    /**
     * BaseObject constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        if (static::$table === '') {
            throw new \Exception("Property 'protected static \$table' must be set within implementation");
        }

        $this->tableName = static::$table;
        $this->db = Database::getInstance();
        $this->logger = new Logger();
    }

    /**
     * Implemented to prevent a fatal error on session storage due to PDO object being available
     *
     * @see https://wiki.php.net/rfc/custom_object_serialization
     * @return array
     */
    public function __serialize(): array
    {
        return $this->getPublicPropertiesWithValues();
    }

    /**
     * Implemented to prevent a fatal error on session storage due to PDO object being available
     *
     * @see https://wiki.php.net/rfc/custom_object_serialization
     * @param array $data
     */
    public function __unserialize(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Always assuming the table properties are the only public properties in the parent class
     *
     * @return array
     */
    private function getPublicPropertiesWithValues(): array
    {
        try {
            $dynamicProperties = (new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
            $objectVars = get_object_vars($this);
            $properties = [];
            foreach ($dynamicProperties as $dynamicProperty) {
                $properties[$dynamicProperty->name] = $objectVars[$dynamicProperty->name];
            }

            return $properties;
        } catch (\Exception $e) {
            $this->logger->error(new \Exception('BaseObject getPublicProperties failed: ' . $e->getMessage()));

            return [];
        }
    }

    /**
     * Insert or update the record in the database
     *
     * @return bool
     */
    public function save(): bool
    {
        $fields = $this->getPublicPropertiesWithValues();
        $keys = array_keys($fields);

        //Check based on ID if we need to INSERT or UPDATE
        if (!empty($this->id)) {
            $updateKeys = array_map(function ($key) {
                return "`$key` = :$key";
            }, $keys);
            $implodedUpdateKeys = implode(',', $updateKeys);
            $query = "UPDATE `{$this->tableName}`
                      SET $implodedUpdateKeys
                      WHERE `id` = :id";
        } else {
            $implodedKeys = implode('`,`', $keys);
            $implodedValues = implode(', :', $keys);
            $query = "INSERT INTO `{$this->tableName}` (`$implodedKeys`)
                      VALUES (:$implodedValues)";
        }

        //Create a prepared statement and bind all values individually
        $statement = $this->db->prepare($query);
        foreach ($fields as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        //Add the ID to the object when it wasn't set yet after saving
        if ($statement->execute()) {
            $this->id = !empty($this->id) ? $this->id : $this->db->lastInsertId();

            return true;
        }
        $this->logger->error(new \Exception("DB Error: {$this->db->errorInfo()[2]}"));

        return false;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public static function delete(int $id): bool
    {
        $db = Database::getInstance();
        $tableName = static::$table;
        $query = "DELETE FROM `{$tableName}`
                  WHERE `id` = :id";

        $statement = $db->prepare($query);

        return $statement->execute([':id' => $id]);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function getAll(): array
    {
        $db = Database::getInstance();
        $tableName = static::$table;
        $select = "$tableName.*";
        $joinQuery = self::getJoinQuery($select);

        return $db->query("SELECT {$select} FROM `{$tableName}`{$joinQuery}")->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public static function getById(int $id): mixed
    {
        $db = Database::getInstance();
        $tableName = static::$table;
        $select = "$tableName.*";
        $joinQuery = self::getJoinQuery($select);

        $statement = $db->prepare("SELECT {$select} FROM `{$tableName}`{$joinQuery} WHERE `{$tableName}`.`id` = :id");
        $statement->execute([':id' => $id]);

        if (($object = $statement->fetchObject(get_called_class())) === false) {
            throw new \Exception("DB Error: ID {$id} is not available in the table {$tableName}");
        }

        return $object;
    }

    /**
     * @param string $select
     * @return string
     * @throws \ReflectionException
     */
    private static function getJoinQuery(string &$select): string
    {
        $tableName = static::$table;
        $joinQuery = '';

        foreach (static::$joinForeignKeys as $joinForeignKey => $properties) {
            $reflect = new \ReflectionClass(new $properties['object']);
            $fields = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
            foreach ($fields as $field) {
                $select .= ", {$properties['table']}.{$field->name} AS {$properties['table']}_{$field->name}";
            }

            $joinQuery .= " LEFT JOIN `{$properties['table']}` ON `{$properties['table']}`.`id` = `{$tableName}`.`{$joinForeignKey}`";
        }

        return $joinQuery;
    }
}
