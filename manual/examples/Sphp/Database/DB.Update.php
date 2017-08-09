<?php

namespace Sphp\Database;

echo Db::update()
        ->table('locations')
        ->set(['a' => 'foobar', 'b' => 'bar', 'c' => 'foo'])
        ->statementToString();
