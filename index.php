<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once './src/core/init.php';

use blog\userClasses\User;
use blog\articleClasses\Article;

$user = new User();
if (!$user->isLoggedIn()) {
    header('Location: login.php');
}

$articles = new Article();
$articlesList = $articles->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>

    <link rel="stylesheet" href="./src/style/main.css">

</head>
<body>
    <div class="container">
        <ul class="article__list">
            <?php foreach ($articlesList as $article) { ?>
                <li class="article__item">
                    <a class="article__item-title" href="article.php?id=<?php echo $article['article_id']; ?>"><?php echo $article['article_title']; ?> ( <?php echo ($article['article_status']) ?'Edited' : 'Original' ?> ) </a>
                    <p class="article__item-date">posted <?php echo date("l jS", $article['article_timestamp']) ?></p>
                </li>
            <?php } ?>
        </ul>
        <div class="button__container">
            <a class="button" href="addArticle.php">Add article</a>
            <a class="button" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
