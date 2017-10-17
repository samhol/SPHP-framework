<pre><?php

use Sphp\Stdlib\Reader\Yaml;

$data = (new Yaml())->fromFile('manual/yaml/document_data.yml');

print_r($data);


?></pre>
