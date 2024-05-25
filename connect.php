<?php

$dsn = "mysql:host=localhost;dbname=yousef";

$user = "root";

$pass = "";

try {
    global $db;

    $db = new PDO($dsn, $user, $pass);

    // echo "done";
}

catch (PDOException $error) {
    echo "failed ". $error;
}