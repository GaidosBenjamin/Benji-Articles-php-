<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('Location: ../index.php');  
} else {
    if(isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        if(empty($username) or empty($password)) {
            $error = 'All fields required!';
        } else {
            $query = $pdo -> prepare("SELECT * FROM user WHERE username = ? AND password = ?");
            $query->bindValue(1, $username);
            $query->bindValue(2, $password);

            $query->execute();

            $num = $query->rowCount();
            
            if($num == 1) {
                $_SESSION['logged_in'] = true;
                $result = $query -> fetch();
                $_SESSION['username'] = $result['username'];
                if($result['is_admin'] == 1) {
                    $_SESSION['is_admin'] = true;
                }

                header('Location: index.php');
                exit();
            } else {
                $error = 'Incorect details!';
            }
        }
    }
        ?>

        <html>
            <head>
                <title>Login</title>
                <link rel="ICON" href="../images/icon.png" type="image/png" />
                <link rel="stylesheet" href="../assets/style.css" />
            </head>

            <body>
                <div class="container">
                    <div class="headc">
                        <a href="../index.php" id="logo">Home</a>
                    </div>

                    <br />

                    <?php if(isset($error)) { ?>
                        <small style="color:aa0000"><?php echo $error?></small>
                        <br /><br/>
                    <?php } ?>

                    <h4>Login</h4>

                    <form action="index.php" method="post" autocomplete="off">
                        <input type="text" name="username" placeholder="Username"/> <br /><br/>
                        <input type="password" name="password" placeholder="Password"/> <br /><br/>
                        <input type="submit" value="Login"/>
                    </form>

                    <br/>

                    <h5>Don't have an account? <a href="signup.php" id="logo">Sign up</a></h5>

                    <br/><br/><br/>

                    <a href="../index.php">&larr; Back</a>

                    <small><h6>All rights reserved Benji Articles S.R.L. 2021</h6></small>
                </div>
            </body>
        </html>
    <?php 
}  

?>