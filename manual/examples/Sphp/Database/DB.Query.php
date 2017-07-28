<?php

namespace Sphp\Database;

echo Db::query()
        ->from('t1', 't2')
        ->get('t1.a', 't2.b as foo', 't1.c')
        ->where('t1.a = :a AND b <> :b', (new Conditions())->equal(['a'=>'foo', 'b' => 'bar']))
        ->orWhere()
        ->groupBy('c')
        ->statementToString();
