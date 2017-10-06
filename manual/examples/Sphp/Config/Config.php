<?php

namespace Sphp\Config;

$conf1 = Config::instance("full of foo");
$conf1->set("foo", "bar");
$conf1->foobar = 'baz';
Config::instance("full of foo")["bar"] = 10.2;

echo "variable 'foo' in 'full of foo' is: $conf1->foo \n";
echo "variable 'foobar' in 'full of foo' is: {$conf1["foobar"]} \n";

print_r(Config::instance("full of foo")->toArray());
