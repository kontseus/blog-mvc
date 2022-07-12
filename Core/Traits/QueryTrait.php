<?php

namespace Core\Traits;

use Core\Model;
use PDO;

trait QueryTrait
{
    use ConnectionTrait;

    static protected string|null $tableName = null;
    static protected string|null $query = '';

    public static function all()
    {
        $query = 'SELECT * FROM ' . static::$tableName;

        return static::connect()->query($query) ->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public static function find(int $id)
    {
        $query = 'SELECT * FROM ' . static::$tableName . ' WHERE id = :id';

        $stmt = static::connect()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchObject(static::class);
    }

    /**
     * Return only one row
     *
     * @param string $column
     * @param        $value
     *
     * @return false|mixed|object|\stdClass|null
     */
    public static function findBy(string $column, $value)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE {$column} = :{$column}";

        $stmt = static::connect()->prepare($query);
        $stmt->bindValue(":{$column}", $value);
        $stmt->execute();

        return $stmt->fetchObject(static::class);
    }

    public static function create(array $fields)
    {
        $vars = static::prepareQueryVars($fields);

        $query = 'INSERT INTO ' . static::$tableName . '(' . $vars['keys'] . ') VALUES (' . $vars['placeholders'] . ')';

        $stmt = static::connect()->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->execute();

        return (int)static::connect()->lastInsertId();
    }

    public function update($fields)
    {
        if (!isset($this->id)) {
            return $this;
        }

        $query = "UPDATE " . static::$tableName . ' SET ' . static::buildPlaceholders($fields) . " WHERE id=:id";

        $stmt = static::connect()->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        $stmt->bindValue('id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        return static::find($this->id);
    }

    public static function delete($id)
    {
        $query = 'DELETE FROM ' . static::$tableName . ' WHERE id = :id';

        $stmt = static::connect()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function select(array $columns = ['*'])
    {
        static::$query = "";
        static::$query = "SELECT " . implode(',', $columns) . " FROM " . static::$tableName . " ";

        return new static();
    }

    public function destroy()
    {
        if (!isset($this->id)) {
            return $this;
        }

        return static::delete($this->id);
    }

    /**
     * $conditions = ['column', '<', 'value']
     *
     * @param array $conditions
     */
    public function where(array $conditions)
    {
        $valueKey = array_key_last($conditions);
        $value = $conditions[$valueKey];
        unset($conditions[$valueKey]);

        static::$query .= ' WHERE ' . implode($conditions) . ' :value';

        $stmt = static::connect()->prepare(static::$query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    protected static function prepareQueryVars(array $fields): array
    {
        $keys = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $keys);

        return [
            'keys' => implode(', ', $keys),
            'placeholders' => implode(', ', $placeholders),
        ];
    }

    private static function buildPlaceholders(array $data): string
    {
        $ps = [];

        foreach ($data as $key => $value) {
            $ps[] = " {$key}=:{$key}";
        }

        return implode(', ', $ps);
    }
}
