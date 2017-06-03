<?php

namespace Sphp\Core\Security;

$password1 = Password::fromPassword('password');
$hash1 = $password1->getHash();
$password2 = Password::fromHash($hash1);

var_dump(
        $password1->verify('password'), 
        $password2->verify('password'));
