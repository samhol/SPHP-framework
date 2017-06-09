<?php

/**
 * AbstractLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\MultiValueAttribute;

/**
 * Implements an abstract layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractLayoutManager implements LayoutManagerInterface {

  /**
   * @var ComponentInterface
   */
  private $component;

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    $this->manage($component);
  }

  public function manage(ComponentInterface $component) {
    $this->component = $component;
    return $this;
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
   * 
   * @return MultiValueAttribute
   */
  public function cssClasses() {
    return $this->component->cssClasses();
  }

  public function __toString(): string {
    return "$this->component";
  }

}
