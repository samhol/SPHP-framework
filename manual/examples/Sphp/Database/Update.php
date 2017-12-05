<?php

namespace Sphp\Database;

use Sphp\Database\Rules\Rule;

$update = Db::update()
        ->table('locations')
        ->set(['country' => 'United Kingdom'])
        ->where(Rule::is('name', 'Hyde Park'));
var_dump($update->affectRows());
