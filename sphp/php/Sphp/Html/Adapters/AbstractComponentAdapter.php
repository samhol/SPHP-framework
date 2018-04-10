<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\ComponentInterface;

/**
 * Abstract base class for HTML component adapters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractComponentAdapter implements Adapter {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var ComponentInterface
   */
  private $component;

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    $this->component = $component;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->component);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __clone() {
    $this->component = clone $this->component;
  }

  /**
   * 
   * @return ComponentInterface
   */
  public function getComponent(): ComponentInterface {
    return $this->component;
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

  public function attributes() {
    return $this->component->attributes();
  }

}
