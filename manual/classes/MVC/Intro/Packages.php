<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\Intro;

use Nadar\PhpComposerReader\ComposerReader;
use Nadar\PhpComposerReader\RequireSection;

/**
 * Description of Packages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Packages {

  /**
   *
   * @var ComposerReader
   */
  private $composer;

  public function __construct() {
    $this->composer = new ComposerReader('./composer.json');
    $section = new RequireSection($this->composer);

    foreach ($section as $package) {
      echo "\n".$package->name . ' with ' . $package->constraint;

      // check if package version gerate then a version constraint.
      if ($package->greaterThan('^6.5')) {
        //echo "\nA lot of releases already!";
      }
    }
    //var_dump($this->composer->getContent());
  }

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
