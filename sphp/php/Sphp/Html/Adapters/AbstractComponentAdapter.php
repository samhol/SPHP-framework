<?php

/**
 * AbstractComponentAdapter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\ComponentInterface;

/**
 * Abstract base class for HTML component adapters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
