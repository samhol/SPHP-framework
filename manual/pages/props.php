<?php

use Sphp\Manual\Apps\Icons\DataFactory;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\FaIconGroup;
use Sphp\Stdlib\Parsers\ParseFactory;

echo '<pre>';
$foo = [];
foreach (ParseFactory::fromFile('/home/int48291/public_html/playground/manual/snippets/icons/fontawesome/icons.yml') as $k => $data) {
  $data['name'] = $k;
  $data['searchTerms'] = $data['search']['terms'];
  $data['factoryName'] = 'Font Awesome';
  $foo[] = new \Sphp\Manual\Apps\Icons\Data\IconGroupData($data);
}
print_r($foo);
