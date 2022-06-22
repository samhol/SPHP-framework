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

/**
 * Description of Package
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractPackage implements Package {

  private string $name;
  private string $restriction;

  /**
   * Constructor
   * 
   * @param string $name
   * @param string $restriction
   */
  public function __construct(string $name, string $restriction) {
    $this->name = $name;
    $this->restriction = $restriction;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getVersion(): string {
    return $this->restriction;
  }

}
