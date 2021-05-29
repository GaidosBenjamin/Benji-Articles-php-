<?php

session_start();

include_once('includes/connection.php');
include_once('includes/article-class.php');

error_reporting(E_ALL ^ E_WARNING); 

$article = new Article;
$articles = $article -> get_all();

if(isset($_SESSION['is_admin'])) {
    ?>
        <html>
            <head>
                <title>Benji Articles</title>
                <link rel="ICON" href="images/icon.png" type="image/png" />
                <link rel="stylesheet" href="assets/style.css" />
            </head>

            <body>
                <div class="headc">
                    <a href="index.php">Home</a>
                    <a href="admin/add.php">Add Article</a>
                    <a href="admin/delete.php">Delete Article</a>
                    <a href="admin/logout.php">Logout</a>
                </div>
                <div class="container">

                    <ol>
                        <?php foreach ($articles as $article) { ?>
                            <li>
                                <a style="font-size:18" href="article.php?id=<?php echo $article['id']?>">
                                    <?php echo $article['title']?>
                                </a>
                                - <small>
                                    <?php echo date('l jS', $article['timestamp']);?>
                                </small>
                            </li>
                        <?php } ?>
                    </ol>

                    <br/>

                    <small><h6>All rights reserved Benji Articles S.R.L. 2021</h6></small>
                </div>
            </body>
        </html>
    <?php
} else {
    ?>
        <html>
            <head>
                <title>Benji Articles</title>
                <link rel="ICON" href="images/icon.png" type="image/png" />
                <link rel="stylesheet" href="assets/style.css" />
            </head>

            <body>
                <div class="headc">
                    <a href="index.php" id="logo">Home</a>
                    <?php
                        if($_SESSION['logged_in']) {
                            ?><a href="admin/logout.php" id="logo">Logout</a><?php
                        } else {
                            ?><a href="admin" id="logo">Login</a><?php
                        }
                    ?>                
                </div>
                <div class="container">

                    <ol>
                        <?php foreach ($articles as $article) { ?>
                            <li>
                                <a style="font-size:18" href="article.php?id=<?php echo $article['id']?>">
                                    <?php echo $article['title']?>
                                </a>
                                - <small>
                                    <?php echo date('l jS', $article['timestamp']);?>
                                </small>
                            </li>
                        <?php } ?>
                    </ol>

                    <br/>

                    <small><h6>All rights reserved Benji Articles S.R.L. 2021</h6></small>
                </div>
            </body>
        </html>
    <?php
}
?>

