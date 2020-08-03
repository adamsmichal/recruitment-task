<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\Input;
use blog\Validator;
use blog\articleClasses\Article;
use blog\userClasses\User;

$user = new User();
if(!$user->isLoggedIn()) {
    header('Location: index.php');
}

if (Input::exist()) {
    $validate = new Validator();
    $validation = $validate->check($_POST, array(
        'title' => array(
            'min' => 5,
            'max' => 16,
            'required' => true,
        ),
        'content' => array(
            'min' => 2,
            'max' => 3000,
            'required' => true,
        ),
    ));

    if ($validation->passed()) {
        $article = new Article();

        try {
            $article->create(array(
                'article_title' => Input::get('title'),
                'article_content' => Input::get('content'),
                'article_timestamp' => time(),
            ));

            header('Location: index.php');

        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo $error, '<br>';
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add article</title>

    <link rel="stylesheet" href="./src/style/main.css">

</head>
<body>
    <main>
        <form action="" method="post">
            <div class="container">
                <div class="field">
                    <label class="label" for="title">Title</label>
                    <input class="input" type="text" name="title" id="title" autocomplete="off">
                </div>

                <div class="field">
                    <label class="label" for="content">Content</label>
                    <textarea class="input-textarea" type="text" name="content" id="content" ></textarea>
                </div>

                <div class="button__container">
                    <input class="button" type="submit" value="Add">
                    <a class="button" href="index.php">Back</a>
                </div>
            </div>
        </form>
    </main>
</body>
</html>