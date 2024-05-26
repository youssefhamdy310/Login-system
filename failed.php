<?php

$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

parse_str(parse_url($url, PHP_URL_QUERY), $urlQuery);

if ($urlQuery['input'] == "empty") {
    header("location: index.php?input=empty");
    exit();
} elseif ($urlQuery['passval'] == "none") {
    header("location: index.php?passval=none");
    exit();
} elseif ($urlQuery['user'] == "found") {
    header("location: index.php?user=found");
    exit();
} elseif ($urlQuery['pass'] == "notmatch") {
    header("location: index.php?pass=notmatch");
    exit();
} elseif ($urlQuery['pass'] == "incorrect") {
    header("location: index.php?pass=incorrect");
    exit();
} elseif ($urlQuery['email'] == "incorrect") {
    header("location: index.php?email=incorrect");
    exit();
} elseif ($urlQuery['both'] == "incorrect") {
    header("location: index.php?both=incorrect");
    exit();
}