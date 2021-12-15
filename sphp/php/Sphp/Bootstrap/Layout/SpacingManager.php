<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Bootstrap\Exceptions\BootstrapException;

/**
 * The SpacingManager class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SpacingManager extends AbstractClassManager {

  /**
   * @var Spacer
   */
  private $spacer;

  public function __construct(ClassAttribute $attr, Spacer $spacer = null) {
    parent::__construct($attr);
    if ($spacer === null) {
      $spacer = new Spacer();
    }
    $this->spacer = $spacer;
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->spacer);
  }

  /**
   * 
   * @param  string $spacings
   * @return $this for a fluent interface
   * @throws BootstrapException
   */
  public function useSpacings(string ... $spacings) {
    $this->spacer->useSpacings(...$spacings);
    $this->spacer->manipulateClassAttribute($this->classAttribute());
    return $this;
  }

}
