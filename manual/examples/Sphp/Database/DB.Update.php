<?php

namespace Sphp\Database;

echo Db::update('foo')
        ->table('t1')
        ->set(['a' => 'foobar', 'b' => 'bar', 'c' => 'foo'])
        ->statementToString();
