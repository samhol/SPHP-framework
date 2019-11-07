<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Parsers\ParseFactory;

function getComposerPackages(): array {
  $composerArr = ParseFactory::fromFile('./composer.json');
  return $composerArr['require'];
}

function getNpmPackages(): array {
  $composerArr = ParseFactory::fromFile('./package.json');
  return $composerArr['dependencies'];
}
