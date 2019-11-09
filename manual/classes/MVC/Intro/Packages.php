<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

/**
 * Description of Packages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Packages {
  
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
}
