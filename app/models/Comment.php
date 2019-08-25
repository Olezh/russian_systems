<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 4:14
 */

namespace app\models;


class Comment
{
    const TABLE = 'comments';

    protected $data;

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @return mixed
     */
    public static function getAlltItems()
    {
        $db = \app\Db::instance();

        $sql = 'SELECT * FROM ' . static::TABLE;

        return $db->query($sql, Comment::class);
    }

    /**
     * В случае успешного запроса к БД присваивает data['id'] номер назначенный базой данных
     */
    public function save()
    {
        $columns = [];
        $params = [];
        $data = [];
        foreach ($this->data as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $columns[] = $name;
            $params[] = ':' . $name;
            $data[':' . $name] = $value;
        }
        $sql = '
        INSERT INTO ' . static::TABLE . ' (' . implode(', ', $columns) . ') 
        VALUES (' . implode(', ', $params) . ')
        ';
        $db = \App\Db::instance();
        $result = $db->execute($sql, $data);
        if ($result !== false) {
            $this->id = $result;
        };
    }

    /**
     * @param array $data
     */
    public function fill(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}