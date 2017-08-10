<?php

namespace Sphp\Database;

echo Db::update()
        ->table('locations')
        ->set(['country' => 'United Kingdom'])->where(Rule::is('name', 'Hyde Park'))
        ->statementToString();
