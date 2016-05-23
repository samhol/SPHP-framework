<?php

namespace Sphp\Net;

$password1 = new Password("password");
$hash1 = $password1->getHashedPassword();
echo "password1 hash: '$hash1'\n";
$password2 = new Password("password");
$hash2 = $password2->getHashedPassword();
echo "password2 hash: '$hash2'\n";
var_dump($password1->validateHash($hash1));
var_dump($password1->validateHash($hash2));
var_dump($password1->validateHash("rge53"));
var_dump($hash1->validatePassword("password"));

echo "password: '" . (new Password("password"))->getHashedPassword(). "'\n";
echo "password: '" . (new Password("password"))->getHashedPassword(). "'\n";
echo "password: '" . new HashedPassword(new Password("password")). "'\n";
echo "password: '" . new HashedPassword(new Password("password")). "'\n";
?>