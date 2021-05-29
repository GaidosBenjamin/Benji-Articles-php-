<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/user-class.php');

$user = new User;

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if(empty($username) or empty($password)) {
        $error = 'All fields required!';
    } else {
        if($user -> check_username($username) == 0) {
            $user -> save_user($username, $password);
            header('Location: index.php');
            exit();
        } else {
            $error = 'Username already exists!';
        }
    }
}
    ?>
<html>
    <head>
        <title>Sign-up</title>
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

            <h4>Sign up</h4>

            <form action="signup.php" method="post" autocomplete="off">
                <input type="text" name="username" placeholder="Username"/> <br /><br/>
                <input type="password" name="password" placeholder="Password"/> <br /><br/>
                <input type="submit" value="Register"/>
            </form>
            
            <br/><br/>

            <a href="index.php">&larr; Back</a>
                
            <small><h6>All rights reserved Benji Articles S.R.L. 2021</h6></small>
        </div>
    </body>
</html>

    
