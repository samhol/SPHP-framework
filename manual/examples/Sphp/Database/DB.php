<?php

namespace Sphp\Database;

$db = Db::instance();
echo $db->query()->from('a')->get('a', 'b', 'c')->groupBy('c')->statementToString();

echo Db::query()->from('a')->get('a', 'b', 'c')->groupBy('c')->statementToString();
echo Db::query('foo')->from('a')->get('a', 'b', 'c')->groupBy('c')->statementToString();
