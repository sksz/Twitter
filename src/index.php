<?php

include('./header.php');

$testUser = new User();
$testUser->setEmail('test1@wp.pl')->setHashPass('haslo')->setUserName('user1');
$testUser->saveToDB($conn);

var_dump($testUser);

include('./footer.php');

