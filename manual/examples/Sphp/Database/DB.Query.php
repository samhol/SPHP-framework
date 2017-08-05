<?php

namespace Sphp\Database;

echo Db::query()
        ->from('t1', 't2')
        ->get('t1.a', 't2.b as foo', 't1.c')
        ->where(['t1.a', '=', 3], ['t2.c', '<>', false], 't1.foo IS NOT NULL')
        ->orWhere(['t1.a', '=', 6])
        ->groupBy('c')
        ->statementToString();
