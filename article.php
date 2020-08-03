<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once './src/core/init.php';

use blog\articleClasses\Article;
use blog\userClasses\User;

$user = new User();
if (!$user->isLoggedIn()) {
    header('Location: index.php');
}

$article = new Article();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $article->fetchData($id);
} else {
    header('Location: index.php');
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data->{"article_title"}; ?></title>

    <link rel="stylesheet" href="./src/style/main.css">

</head>
<body>
<div class="container">
    <h4 class="article__title">
        <?php echo $data->{"article_title"}; ?>
    </h4>

    <p class="article__content"><?php echo $data->{"article_content"}; ?></p>

    <div class="button__container">
        <a class="button" href="editArticle.php?id=<?php echo $data->{"article_id"}; ?>">Edit this article</a>
        <a class="button" href="index.php">Back</a>
    </div>
</div>
</body>
</html>