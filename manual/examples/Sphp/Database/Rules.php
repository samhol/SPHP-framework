<?php

namespace Sphp\Database;
try {
  $rules = new Rules();
$r1 = new Rule('a = ?', 'foo');
$rules->append($r1);
$rules->append(Rule::isNotIn('bar', [1, 2, 3, 4, 5, 6, 'foobar']));
$rules1 = new Rules();
$rules1->append(Rule::compare('c', '<>', null));
$rules1->append(Rule::compare('d', '=', null), 'OR');
$rules->append($rules1, 'XOR');
$rules->append(Rule::isLike('daa', '%blaa%'));
$rules->append(Rule::isLike('daa', '%blaa%'), 'or');
$rules->append(Rule::is('something', 'unknown'));
echo $rules;
print_r($rules->getParams()->toArray());
} catch (\Throwable $ex) {
echo new \Sphp\Html\Foundation\Sites\Containers\ThrowableCallout($ex);
}

