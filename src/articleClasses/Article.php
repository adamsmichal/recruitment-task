<?php

namespace blog\articleClasses;

use blog\Database;
use Exception;

class Article
{
    private ?Database $_database;

    public function __construct()
    {
        $this->_database = Database::getInstance();
    }

    //Find an article with id === $id
    public function fetchData($id)
    {
        $this->_database->get('articles', array('article_id', '=', $id));
        return $this->_database->first();
    }

    //Find all articles in database
    public function fetchAll()
    {
        return $this->_database->getAll('articles');
    }

    //Submit the article information to the database class
    public function create($fields = array())
    {
        if ($this->_database->insert('articles', $fields)) {
            throw new Exception('There was a problem creating an article.');
        }
    }

    //Submit updated article information to the database
    public function update($id, $fields)
    {
        if (!$this->_database->update('articles', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    //Send which article is to be deleted
    public function remove($id, $fields)
    {
        if ($fields['article_remove'] === "on") {
            if (!$this->_database->remove('articles', $id)) {
                return false;
            }
            return true;
        }
    }
}