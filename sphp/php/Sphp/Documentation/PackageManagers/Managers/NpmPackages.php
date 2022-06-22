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

use Sphp\Stdlib\Parsers\ParseFactory;
use IteratorAggregate;
use Traversable;

/**
 * Description of Packages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NpmPackages implements IteratorAggregate, PackageManager {

  /**
   * @var array
   */
  private array $npm;

  /**
   * Constructor
   * 
   * @param string $path
   */
  public function __construct(string $path) {
    $this->npm = ParseFactory::fromFile($path);
  }

  public function getProductionPackages(): iterable {
    foreach ($this->npm['dependencies'] as $name => $constraint) {
      yield new NpmPackage($name, $constraint);
    }
  }

  public function getDevPackages(): iterable {
    foreach ($this->npm['devDependencies'] as $name => $constraint) {
      yield new NpmPackage($name, $constraint);
    }
  }

  public function getIterator(): Traversable {
    yield from $this->getProductionPackages();
    yield from $this->getDevPackages();
  }

}
