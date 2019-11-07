<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Parsers\ParseFactory;

function getPHPVersion(): string {
  $composerArr = getComposerPackages('require');
  return $composerArr['php'];
}

function getComposerPackages(string $type = 'require'): array {
  $composerArr = ParseFactory::fromFile('./composer.json');
  return $composerArr[$type];
}

function getNpmPackages(): array {
  $composerArr = ParseFactory::fromFile('./package.json');
  return $composerArr['dependencies'];
}
