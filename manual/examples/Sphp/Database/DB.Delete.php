<?php

namespace Sphp\Database;

$db = Db::instance();
echo $db->query()->from('t1')->get('a', 'b', 'c')->groupBy('c')->statementToString();

echo Db::query()->from('t1')->get('a', 'b', 'c')->groupBy('c')->statementToString();
echo Db::query('foo')->from('t1')->get('a', 'b', 'c')->groupBy('c')->statementToString();
