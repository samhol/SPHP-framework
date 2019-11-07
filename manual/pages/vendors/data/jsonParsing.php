<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Parsers\ParseFactory;

function getComposerPackages(string $type = 'require'): array {
  $composerArr = ParseFactory::fromFile('./composer.json');
  return $composerArr[$type];
}

function getNpmPackages(): array {
  $composerArr = ParseFactory::fromFile('./package.json');
  return $composerArr['dependencies'];
}
