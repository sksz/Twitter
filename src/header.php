<?php
require_once('include.php');

$userEmail = 'aaa@onet.pl';
$userPassword = 'haslo';

$loggeduser = Auth::user($userEmail, $userPassword);

if (PHP_SESSION_NONE === session_status()) {
    session_start([
        'cookie_lifetime' => 5 * 60,
    ]);
} else {
    $_SESSION["userName"] = $user->getName();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>
</head>

<body>
