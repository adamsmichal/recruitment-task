<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\Input;
use blog\Validator;
use blog\articleClasses\Article;
use blog\userClasses\User;

$user = new User();
if (!$user->isLoggedIn()) {
    header('Location: index.php');
}

$article = new Article();
$id = $_GET['id'];
$data = $article->fetchData($id);

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

    if ($validate->passed()) {
        try {
            $article->update($id, [
                'article_title' => Input::get('title'),
                'article_content' => Input::get('content'),
                'article_status' => 1,
            ]);

            $article->remove($id, [
                'article_remove' => Input::get('article_remove')
            ]);

            if (Input::get('article_remove') === 'on') {
                header('Location: index.php');
            } else {
                header("Location: article.php?id={$data->{"article_id"}}");
            }

        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {
        foreach ($validate->errors() as $error) {
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
    <title>Edit <?php echo $data->{"article_title"} ?></title>

    <link rel="stylesheet" href="./src/style/main.css">

</head>
<body>
<main>
    <form action="" method="post">
        <div class="container">
            <div class="field__edit">
                <input class="input__edit" type="text" name="title" id="title"
                       value="<?php echo $data->{"article_title"} ?>"
                       autocomplete="off">
            </div>

            <div class="field__edit">
                <textarea class="input__edit-textarea" type="text" name="content" id="content"
                          autocomplete="off"><?php echo $data->{"article_content"} ?></textarea>
            </div>

            <div class="field-select">
                <label class="label-select" for="article_remove">Delete</label>
                <input class="input-select" type="checkbox" name="article_remove" id="article_remove">
            </div>

            <div class="button__container">
                <input class="button" type="submit" value="Update">
                <a class="button" href="index.php">Back</a>
            </div>
        </div>
    </form>
</main>
</body>
</html>