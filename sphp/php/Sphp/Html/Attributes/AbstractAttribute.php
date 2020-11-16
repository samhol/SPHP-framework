<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Html\Attributes\Exceptions\AttributeException;

/**
 * Class AbstractAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractAttribute implements Attribute {

  /**
   * the name of the attribute
   *
   * @var string 
   */
  private $name;

  /**
   * @var boolean 
   */
  private $isInstantiated = false;

  /**
   * Constructor
   *
   * @param  string $name the name of the attribute
   * @throws BadMethodCallException if the constructor is recalled
   * @throws AttributeException
   */
  public function __construct(string $name) {
    if (true === $this->isInstantiated) {
      throw new BadMethodCallException('Constructor called twice.');
    }
    if (!Strings::match($name, '/^[a-zA-Z][\w:.-]*$/')) {
      throw new AttributeException("Malformed Attribute name '$name'");
    }
    $this->name = $name;
    $this->isInstantiated = true;
  }

  public function __toString(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $value = $this->getValue();
        if (is_string($value)) {
          $value = preg_replace('/[\t\n\r]+/', ' ', $value);
          $output .= '="' . htmlspecialchars($value, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
        } else {
          $output .= '="' . $value . '"';
        }
      }
    }
    return $output;
  }

  public function getName(): string {
    return $this->name;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || ($this->getValue() !== false && $this->getValue() !== null);
  }

  public function isEmpty(): bool {
    $val = $this->getValue();
    return is_bool($val) || $val === null;
  }

}
