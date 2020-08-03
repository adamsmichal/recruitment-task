<?php

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'db' => 'aurora',
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token',
    ),
);
