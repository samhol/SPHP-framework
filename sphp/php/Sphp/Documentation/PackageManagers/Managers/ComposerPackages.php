<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\PackageManagers\Managers;

use IteratorAggregate;
use Traversable;
use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Description of Packages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ComposerPackages implements IteratorAggregate, PackageManager {
 
  private array $composer;

  public function __construct(string $path) {
    $this->composer = ParseFactory::json()->fileToArray($path);
  }

  public function getPHPVersion(): string {
    return $this->composer['require']['php'];
  }

  public function getProductionPackages(): iterable {
    foreach ($this->composer['require'] as $name => $constraint) {
      if ($name !== 'php') {
        yield new ComposerPackage($name, $constraint);
      }
    }
  }

  public function getDevPackages(): iterable {
    foreach ($this->composer['require-dev'] as $name => $constraint) {
      yield new ComposerPackage($name, $constraint);
    }
  }

  /**
   * 
   * @return Traversable<ComposerPackage>
   */
  public function getIterator(): Traversable {
    yield from $this->getProductionPackages();
    yield from $this->getDevPackages();
  }

}
