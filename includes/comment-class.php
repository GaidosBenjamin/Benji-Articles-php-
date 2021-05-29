<?php

class Comment {
   
    public function get_articles($id) {
        global $pdo;

        $query = $pdo -> prepare("SELECT * FROM comment where article_id = ?");
        $query -> bindValue(1, $id);
        $query -> execute();

        return $query -> fetchAll();
    }
}

?>