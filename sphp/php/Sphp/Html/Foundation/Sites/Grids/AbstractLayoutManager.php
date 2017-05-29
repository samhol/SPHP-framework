<?php

/**
 * AbstractLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

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
   * @var MultiValueAttribute
   */
  private $cssClasses;

  /**
   * Constructs a new instance
   * 
   * @param MultiValueAttribute $cssClasses
   */
  public function __construct(MultiValueAttribute $cssClasses) {
    $this->cssClasses = $cssClasses;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->cssClasses);
  }

  /**
   * 
   * @return MultiValueAttribute
   */
  public function cssClasses() {
    return $this->cssClasses;
  }

  public function __toString() {
    return "$this->cssClasses";
  }

}
