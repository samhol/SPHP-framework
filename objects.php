<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Db\Objects;

require_once 'manual/settings.php';

require_once 'bootstrap.php';
//require_once 'database/bootstrap/autoload.php';


echo "<pre>";
$userArr = [
    "username" => "samhol",
    "fname" => "Sami",
    //"lname" => "Holck",
    "street" => "Rakuunatie 59 A 3",
    "zipcode" => "20720",
    //"city" => "Turku",
    "country" => "Finland"];
$user = new User($userArr);
print_r($user->toArray());

//$results = \DB::select('SELECT users.*, addresses.* FROM users join userAddr on uid=user_id join addresses on address_id = addrid where uid = ?', array(1));
//print_r($results);

echo "</pre>";



$user = [
    "name" => "user",
    "columns" =>
    [
        "username" => ["type" => "string"],
        "fname" => "Sami",
        "lname" => "Holck",
        "street" => "Rakuunatie 59 A 3",
        "zipcode" => "20720",
        "city" => "Turku",
        "country" => "Finland"
    ]
];
