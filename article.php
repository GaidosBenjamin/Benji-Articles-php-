<?php 

session_start();

include_once('includes/connection.php');
include_once('includes/article-class.php');
include_once('includes/comment-class.php');

error_reporting(E_ALL ^ E_WARNING); 

$article = new Article;
$comment = new Comment;

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $article -> get_article($id);
    $comments = $comment -> get_articles($id);

    if(isset($_POST['comment'])) {
        $comment = nl2br($_POST['comment']);

        if(empty($comment)) {
            $error = 'All fields are required';
        } else {
            $query = $pdo -> prepare('INSERT INTO comment (content, username, timestamp, article_id) VALUES (?, ?, ?, ?)');

            $query -> bindValue(1, $comment);
            $query -> bindValue(2, $_SESSION['username']);
            $query -> bindValue(3, time());
            $query -> bindValue(4, $id);

            $query -> execute();

            header('Location: article.php?id=' . $id);
        }
    }

    ?>
        <html>
            <head>
                <title>Articles</title>
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

                    <h3><?php echo $data['title']?></h3>
                    - <small>posted <?php echo date('l jS', $data['timestamp'])?></small>

                    <p><?php echo $data['content']?></p>

                    <a href="index.php">&larr; Back</a>

                    <br/><br/><br/>

                    <?php foreach($comments as $comment) { ?>
                        <h5><?php echo $comment['username']?></h5>
                        - <small>said on <?php echo date('l jS', $comment['timestamp'])?></small>

                        <p style="font-size:14"><?php echo $comment['content']?></p><br/>
                    <?php } 
                    
                    if($_SESSION['logged_in']) { ?>
                        <form method="post">
                            <input type="submit" name="add-comment" value="Add comment"/>
                        </form>
                    <?php }
                    
                    if(isset($error)) { ?>
                        <small style="color:aa0000"><?php echo $error?></small>
                        <br /><br/>
                    <?php } 
                    
                    if(array_key_exists('add-comment', $_POST)) { ?>
                        <form action="article.php?id=<?php echo $id?>" method="post" autocomplete="off">
                            <textarea rows="5" cols="60" placeholder="Comment" name="comment"></textarea><br/><br/>
                            <input type="submit" value="Add" />
                        </form>
                    <?php } ?>
                </div>
            </body>
        </html>

    <?php

} else {
    header('Location: index.php');
    exit();
}

?>