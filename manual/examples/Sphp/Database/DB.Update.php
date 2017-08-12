<?php

namespace Sphp\Database;

$update = Db::update()
        ->table('locations')
        ->set(['country' => 'United Kingdom'])
        ->where(Rule::is('name', 'Hyde Park'));
var_dump($update->affectRows());
