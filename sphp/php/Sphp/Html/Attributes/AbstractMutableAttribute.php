<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * An abstract implementation of an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractMutableAttribute extends AbstractAttribute implements MutableAttribute {

  /**
   * whether the attribute is always visible or not
   *
   * @var boolean
   */
  private bool $alwaysVisible = false;

  public function forceVisibility() {
    $this->alwaysVisible = true;
    return $this;
  }

  public function isAlwaysVisible(): bool {
    return $this->alwaysVisible;
  }

  public function isVisible(): bool {
    return $this->isAlwaysVisible() || ($this->getValue() !== false && $this->getValue() !== null);
  }

}
