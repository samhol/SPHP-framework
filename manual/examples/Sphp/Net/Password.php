<?php

namespace Sphp\Net;

$password1 = new Password("password");
$hash1 = $password1->getHash();
echo "password1 hash: '$hash1'\n";
$password2 = new Password("password");
$hash2 = $password2->getHash();
echo "password2 hash: '$hash2'\n";
var_dump($password1->verify("password"));
var_dump($password1->verify($password1));
var_dump($password1->verify("$password2"));
//var_dump($hash1->verify("password"));

echo "password: '" . (new Password("password"))->getHash(). "'\n";
echo "password: '" . (new Password("password"))->getHash(). "'\n";
echo "password: '" . new HashedPassword(new Password("password")). "'\n";
echo "password: '" . new HashedPassword(new Password("password")). "'\n";
?>