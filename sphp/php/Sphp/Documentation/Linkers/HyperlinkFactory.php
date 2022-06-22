<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;

use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Navigation\A;

/**
 * Defines an attribute injector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HyperlinkFactory {

  /**
   * @var AttributeContainer
   */
  private AttributeContainer $attributes;

  /**
   * Constructor
   */
  public function __construct() {
    $this->attributes = new AttributeContainer();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->attributes);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attributes = clone $this->attributes;
  }

  public function getCopy(): HyperlinkFactory {
    return clone $this;
  }

  /**
   * Adds CSS class(es) to the factory
   * 
   * @param  string ... $class
   * @return $this for a fluent interface
   */
  public function useCssClass(string ...$class) {
    $this->attributes->classes()->add(...$class);
    return $this;
  }

  /**
   * Add a CSS class(es) to the factory
   * 
   * @param  string ... $class
   * @return $this for a fluent interface
   */
  public function removeCssClass(string ...$class) {
    $this->attributes->classes()->remove(...$class);
    return $this;
  }

  /**
   * 
   * @param  string|null $value
   * @return $this for a fluent interface
   */
  public function useRel(?string $value = null) {
    $this->attributes->setAttribute('rel', $value);
    return $this;
  }

  /**
   * 
   * @param  string|null $value
   * @return $this for a fluent interface
   */
  public function useTarget(?string $value = null) {
    $this->attributes->setAttribute('target', $value);
    return $this;
  }

  public function getAttributes(): array {
    return $this->attributes->toArray();
  }

  public function buildHyperlink(string $url, $content = null, ?string $title = null): A {
    $a = new A($url, $content);
    foreach ($this->attributes as $attr) {
      $a->attributes()->setInstance($attr);
    }
    $a->setAttribute('title', $title);
    return $a;
  }

}
