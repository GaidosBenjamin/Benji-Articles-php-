<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/article-class.php');

$article = new Article;

if(isset($_SESSION['logged_in'])) {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = $pdo -> prepare('DELETE FROM article WHERE id = ?');
        $query -> bindValue(1, $id);
        $query -> execute();

        header('Location: delete.php');
    }
    $articles = $article -> get_all();

    ?>

        <html>
            <head>
                <title>Delete</title>
                <link rel="ICON" href="../images/icon.png" type="image/png" />
                <link rel="stylesheet" href="../assets/style.css" />
            </head>

            <body>
                <div class="headc">
                    <a href="index.php" id="logo">Home</a>
                    <?php
                        if($_SESSION['logged_in']) {
                            ?><a href="logout.php" id="logo">Logout</a><?php
                        } else {
                            ?><a href="index.php" id="logo">Login</a><?php
                        }
                    ?>                
                </div>
                <div class="container">

                    <br />

                    <h4>Select an article to delete</h4>

                    <form action="delete.php" method="get">
                        <select onchange="this.form.submit();" name="id">
                            <?php foreach($articles as $article) { ?>
                                <option value="<?php echo $article['id']; ?>">
                                    <?php echo $article['title']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </form>

                    <br/><br/>

                    <a href="../index.php">&larr; Back</a>

                    <small><h6>All rights reserved Benji Articles S.R.L. 2021</h6></small>
                </div>
            </body>
        </html>

    <?php
} else {
    header('Location: index.php');
}

?>