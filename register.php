<?php
require_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\Validator;
use blog\Token;
use blog\Session;
use blog\Input;
use blog\userClasses\User;
use blog\userClasses\Hash;

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
    if (Token::check(Input::get('token'))) {
        $validate = new Validator();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'unique' => 'users'
            ),
            'password' => array(
                'required' => true,
                'min' => 6,
            ),
            'password_again' => array(
                'required' => true,
                'matches' => 'password'
            ),
        ));

        if ($validation->passed()) {
            $user = new User();

            try {

                $user->create(array(
                    'user_name' => Input::get('username'),
                    'user_email' => Input::get('email'),
                    'user_password' => Hash::make(Input::get('password')),
                ));

                header('Location: index.php');

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            echo '<div class="validation-error-box">';
            foreach ($validation->errors() as $error) {
                echo '<p class="validation-error">', $error, '</p>';
            }
            echo '</div>';
        }
    }
}
?>
    <main>
        <form action="" method="post">
            <div class="container">
                <div class="field">
                    <label class="label" for="username">Username</label>
                    <input class="input" type="text" name="username" id="username" autocomplete="off">
                </div>

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <input class="input" type="email" name="email" id="email" autocomplete="off">
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <input class="input" type="password" name="password" id="password">
                </div>

                <div class="field">
                    <label class="label" for="password_again">Repeat password</label>
                    <input class="input" type="password" name="password_again" id="password_again">
                </div>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <div class="button__container">
                    <input class="button" type="submit" value="Register">

                    <a class="button" href="login.php">I have an account</a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>

