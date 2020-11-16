<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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
   * whether the attribute is required or not
   *
   * @var boolean
   */
  private $required = false;

  /**
   * @var boolean 
   */
  private $protected = false;

  public function isProtected(): bool {
    return $this->protected;
  }

  public function protectValue($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->setValue($value);
    $this->protected = true;
    return $this;
  }

  public function forceVisibility() {
    if (!$this->isVisible()) {
      $this->setValue(true);
    }
    $this->required = true;
    return $this;
  }


  public function isDemanded(): bool {
    return $this->required;
  }
}
