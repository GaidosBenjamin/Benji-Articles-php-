<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=articole', 'root', '');
} catch (PDOException $e) {
    exit('Database error!');
}

?>