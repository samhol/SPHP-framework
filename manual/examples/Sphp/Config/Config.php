<?php

namespace Sphp\Config;

Config::instance("foo")
        ->set("foo", "bar");

echo "Current Configurator domain is: '" . Config::instance("foo")->foo . "'\n";


Config::instance("foobar", [], false)
        ->set("foo", "foo bar");

print_r(Config::instance("foo")->toArray());
print_r(Config::instance("foobar")->toArray());
