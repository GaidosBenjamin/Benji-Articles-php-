<?php

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {
    if(isset($_POST['title'], $_POST['content'])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        if(empty($title) or empty($content)) {
            $error = 'All fields are required';
        } else {
            $query = $pdo -> prepare('INSERT INTO article (title, content, timestamp) VALUES (?, ?, ?)');

            $query -> bindValue(1, $title);
            $query -> bindValue(2, $content);
            $query -> bindValue(3, time());

            $query -> execute();

            header('Location: index.php');
        }
    }

    ?>
        <html>
            <head>
                <title>Add</title>
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

                    <h4>Add Article</h4>

                    <?php if(isset($error)) { ?>
                        <small style="color:aa0000"><?php echo $error?></small>
                        <br /><br/>
                    <?php } ?>

                    <form action="add.php" method="post" autocomplete="off">
                        <input type="text" name="title" placeholder="Title" /><br/><br/>
                        <textarea rows="15" cols="50" placeholder="Content" name="content"></textarea><br/><br/>
                        <input type="submit" value="Add Article" />
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