<?php
include 'connect.php';
function is_empty($value) {
    if ($value === NULL) {
        return true;
    } else {
        return false;
    }
}

function validatePassword($password) {
    if (strlen($password) <= 4) {
        return false;
    }
    if (preg_match("/[*&@#$!%^()]/", $password)) {
        return false;
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return false;
    }
    if (!preg_match("/\d/", $password)) {
        return false;
    }
    if (!preg_match("/[a-z]/", $password)) {
        return false;
    }

    return true;
}

