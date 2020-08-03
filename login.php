<?php

include_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\Input;
use blog\Validator;
use blog\Token;
use blog\userClasses\User;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="./src/style/main.css">

</head>
<body>
<?php
if (Input::exist()) {
    if(Token::check(Input::get('token'))){
        $validate = new Validator();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )));

        if ($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('email'), Input::get('password'));

            if ($login) {
                header('Location: index.php');
            } else {
                echo '<p>Sorry, logging in failed.</p>';
            }

        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }

}
?>
<form action="" method="post">
    <div class="container">
        <div class="field">
            <label class="label" for="email">Email</label>
            <input class="input" type="email" name="email" id="email" autocomplete="off">
        </div>

        <div class="field">
            <label class="label" for="password">Password</label>
            <input class="input" type="password" name="password" id="password">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <div class="button-container">
            <input class="button" type="submit" value="Log in">

            <a class="button" href="register.php">Create an account</a>
        </div>
    </div>
</form>


</body>
</html>
