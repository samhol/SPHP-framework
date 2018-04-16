<?php

namespace Sphp\Database;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

try {
  $rules = new Clause();
  $r1 = new Rule('a', '=', 'foo');
  $rules->fulfills($r1);
  $rules->fulfills(Rule::isNotIn('bar', [1, 2, 'foobar']));
  $rules->fulfills(Rule::isIn('foobar', [6, 'foobar']));
  $rules1 = new Clause();
  $rules1->fulfills(Rule::compare('c', '<>', null));
  $rules1->fulfills(Rule::compare('d', '=', null), 'OR');
  $rules->fulfills($rules1, 'XOR');
  $rules->fulfills(Rule::isLike('daa', '%blaa%'));
  $rules->fulfills(Rule::isLike('daa', '%blaa%'), 'or');
  $rules->fulfills(Rule::is('something', 'unknown'));
  echo $rules . "\n";
  print_r($rules->getParams()->toArray());
} catch (\Throwable $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}

