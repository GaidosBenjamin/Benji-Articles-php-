<?php

class Article {
    public function get_all() {
        global $pdo;

        $query = $pdo -> prepare("SELECT * FROM article");
        $query -> execute(); 

        return $query -> fetchAll();
    }

    public function get_article($id) {
        global $pdo;

        $query = $pdo -> prepare("SELECT * FROM article where id = ?");
        $query -> bindValue(1, $id);
        $query -> execute();

        return $query -> fetch();
    }
}

?>