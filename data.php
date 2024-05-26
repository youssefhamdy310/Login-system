<?php
session_start();
include 'functions.php';
// var_dump($db);
include 'connect.php';
$db = new PDO($dsn, $user, $pass);
if (isset($_POST['signup-submit'])) {
    $email = $_POST['signup-email'];
    $username = $_POST['signup-username'];
    $password = $_POST['signup-password'];
    $confirmPassword = $_POST['confirm-password'];
    $phone = $_POST['signup-phone'];
    function usernameFound($value) {
        include 'connect.php';
        $db = new PDO($dsn, $user, $pass);
        $query = $db->prepare("SELECT * FROM `users` WHERE `username` LIKE '$value'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    if (is_empty($email) || is_empty($username) || is_empty($password) || is_empty($email) || is_empty($phone)) {
        header("location: failed.php?input=empty");
        exit();
    } elseif (!validatePassword($password)) {
        header("location: failed.php?passval=none");
        exit();
    } elseif(usernameFound($username)) {
        header("location: failed.php?user=found");
        exit();
    } elseif($password !== $confirmPassword) {
        header("Location: failed.php?pass=notmatch");
        exit();
    } else {
        $query = $db->prepare("INSERT INTO `users`(`email`, `username`, `password`, `phone`) VALUES ('$email','$username','$password','$phone')");
        $query->execute();
        header("location: home.php");
        exit();
    }
    
} elseif (isset($_POST['login-submit'])) {
    $email = $_POST['login-username-or-email'];
    $password = $_POST['login-password'];
    function usernameOrEmailFound($value) {
        include 'connect.php';
        $db = new PDO($dsn, $user, $pass);
        $query = $db->prepare("SELECT * FROM `users` WHERE `email` LIKE '$value' OR username LIKE '$value'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    function passwordFound($value) {
        include 'connect.php';
        $db = new PDO($dsn, $user, $pass);
        $query = $db->prepare("SELECT * FROM `users` WHERE `password` LIKE '$value'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }

    function incorrectInputs ($value, $password) {
        include 'connect.php';
        $db = new PDO($dsn, $user, $pass);
        $query = $db->prepare("SELECT * FROM `users` WHERE `email` LIKE '$value'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($password !== $result['password']) {
            return true;
        } else {
            return false;
        }
    }

    if (usernameOrEmailFound($email)) {
        if (incorrectInputs($email, $password)) {
            header("location: failed.php?pass=incorrect");
            exit();
        } else {
            header("location: home.php");
            exit();
        }
    } else {
        if (passwordFound($password)) {
            header("location: failed.php?email=incorrect");
            exit();
        } else {
            header("location: failed.php?both=incorrect");
            exit();
        }
    }
    
}