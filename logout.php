<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\userClasses\User;

$user = new User();
$user->logout();

header('Location: login.php');