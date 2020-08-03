<?php

namespace blog\userClasses;

use blog\Config;
use blog\Database;
use blog\Session;

class User
{
    private ?Database $_database;
    private $_data;
    private $_sessionName;
    private bool $_isLoggedIn = false;

    public function __construct($user = null)
    {
        $this->_database = Database::getInstance();

        $this->_sessionName = Config::get('session/session_name');

        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);

                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                }
            }
        } else {
            $this->find($user);
        }
    }

    //Submit the user information to the database class
    public function create($fields = array())
    {
        if ($this->_database->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    //Find user by id or email
    public function find($user = null)
    {
        if ($user) {
            $field = (is_numeric($user)) ? 'user_id' : 'user_email';
            $data = $this->_database->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    }

    //Check if the mail exists -> Check if the password is correct
    public function login($email = null, $password = null)
    {
        $user = $this->find($email);

        if ($user) {
            if ($this->data()->user_password === Hash::make($password)) {
                Session::put($this->_sessionName, $this->data()->user_id);
                return true;
            }
        }

        return false;
    }

    public function logout() {
        Session::delete($this->_sessionName);
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }
}