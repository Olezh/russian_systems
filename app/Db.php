<?php
/**
 * Created by PhpStorm.
 * User: Ol
 * Date: 25.08.2019
 * Time: 3:32
 */

namespace app;


class Db
{
    use Singleton;
    protected $dbh;

    public function __construct()
    {
        $config = \app\Config::instance();
        try {
            $this->dbh = new \PDO($config->data['db']['dbtype'] . ':host=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'], $config->data['db']['password']);
            $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception ($e->getMessage());
        }
    }
    /**
     * @param $sql
     * @param string $class
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function query($sql, string $class, array $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
        } catch (\PDOException $e) {
            throw new \Exception ($e->getMessage());
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param $sql
     * @param array $data
     * @return string
     * @throws \Exception
     */
    public function execute($sql, array $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
            return $this->dbh->lastInsertId();
        } catch (\PDOException $e) {
            throw new \Exception ($e->getMessage());
        }
    }

    /**
     * @param $sql
     * @param string $class
     * @param array $data
     * @return \Generator
     * @throws \Exception
     */
    public function queryEach($sql, string $class, array $data = [])
    {
        try {
            $sth = $this->dbh->prepare($sql);
            $sth->execute($data);
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        } catch (\PDOException $e) {
            throw new \Exception ($e->getMessage());
        }
        while ($row = $sth->fetch()) {
            yield $row;
        }
    }
}