<?php

class User {
    public function save_user($username, $password) {
        global $pdo;

        $query = $pdo -> prepare("INSERT INTO user (username, password, is_admin) VALUES (?, ?, ?)");
        $query -> bindValue(1, $username);
        $query -> bindValue(2, $password);
        $query -> bindValue(3, 0);

        $query -> execute();
    }

    public function check_username($username) {
        global $pdo;

        $query = $pdo -> prepare("SELECT * FROM user where username = ?");
        $query -> bindValue(1, $username);
        $query -> execute();

        return $query -> rowCount();
    }
}

?>