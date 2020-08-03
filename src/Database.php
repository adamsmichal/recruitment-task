<?php

namespace blog;

use PDO;

class Database
{
    private static ?Database $_instance = null;
    private  $_query;
    private  $_results;
    private bool $_error = false;
    private int $_count = 0;
    private PDO $_pdo;

    //connect to the database
    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    //create a class instance
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //contact with database and mysql execute
    public function query($sql, $params = array())
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    //create mysql commands
    public function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }

        return false;
    }

    //get any value from any table
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    //get all value from any table
    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $this->_query = $this->_pdo->prepare($sql);
        $this->_query->execute();
        return $this->_query->fetchAll();
    }

    public function result()
    {
        return $this->_results;
    }

    //insert a new data to any table
    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = null;
            $x = 1;

            //convert fields into mysql keys
            foreach ($fields as $field) {
                $values .= "?";
                if ($x < count($fields)) {
                    $values .= ',';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('` , `', $keys) . "`) VALUES ({$values})";

            if ($this->query($sql, $fields)->error()) {
                return true;
            }
        }

        return false;
    }

    //create mysql and update data
    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE article_id = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    //remove data from table
    public function remove($table, $id) {
        $sql = "DELETE FROM {$table} WHERE article_id = {$id}";

        $db = $this->_pdo->prepare($sql);

        if($db->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function first()
    {
        return $this->result()[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }
}