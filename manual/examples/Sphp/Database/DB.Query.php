<?php

namespace Sphp\Database;

echo Db::query()
        ->from('t1')
        ->get('a', 'b', 'c')
        ->where('a = :a AND b <> :b', (new Conditions())->equal(['a'=>'foo', 'b' => 'bar']))
        ->groupBy('c')
        ->statementToString();
