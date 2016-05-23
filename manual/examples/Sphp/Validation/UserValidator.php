<?php

namespace Sphp\Validation;

$user = [
    "fname" => "",
    "phone" => "wrong phone number",
    "email" => "foo",
    "city" => "1"
];

$validator = (new UserValidator());
echo $validator->validate($user)->getErrors();
?>
