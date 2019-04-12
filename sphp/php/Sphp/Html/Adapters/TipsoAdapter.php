<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\Component;
use Sphp\Html\Attributes\JsonAttribute;

/**
 * Inserts a Tipso style tooltip to the adaptee
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://tipso.object505.com/ Tipso
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TipsoAdapter extends AbstractComponentAdapter implements \ArrayAccess {

  /**
   * @var JsonAttribute
   */
  private $config = [];

  /**
   * Constructor
   * 
   * @param Component $component
   * @param string|null $content the value of the title attribute
   */
  public function __construct(Component $component, string $content = null) {
    parent::__construct($component);
    $component->setAttribute('data-sphp-tipso');
    $this->config = new JsonAttribute('data-sphp-tipso-options');
    $component->attributes()
            ->setInstance($this->config);
    if ($content !== null) {
      $this->setTitle($content);
    }
  }

  public function setOption(string $name, $value) {
    $this[$name] = $value;
    return $this;
  }

  /**
   * Sets the value of the title
   *
   * @param  string|null $title the value of the title attribute
   * @return $this for a fluent interface
   */
  public function setTitle(string $title = null) {
    $this['titleContent'] = $title;
    return $this;
  }

  /**
   * Sets the content
   *
   * @param  string|null $content the content
   * @return $this for a fluent interface
   */
  public function setContent(string $content = null) {
    $this['content'] = $content;
    return $this;
  }

  /**
   * Checks whether an option exists
   * 
   * @param  mixed $name option name
   * @return bool
   */
  public function offsetExists($name): bool {
    return $this->config->offsetExists($name);
  }

  /**
   * Returns the option value
   * 
   * @param  mixed $name option name
   * @return scalar|null option value or null if not present
   */
  public function offsetGet($name) {
    return $this->config->offsetGet($name);
  }

  /**
   * 
   * @param  mixed $name option name
   * @param  mixed $value
   * @return void
   * @throws InvalidArgumentException if the name or the value is invalid
   */
  public function offsetSet($name, $value): void {
    $this->config->offsetSet($name, $value);
  }

  /**
   * Removes an option
   * 
   * @param  mixed $name option name
   * @return void
   */
  public function offsetUnset($name): void {
    $this->config->offsetUnset($name);
  }

}
