<?php

/**
 * AbstractBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractComponent;

/**
 * Implements an abstract Foundation Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractBar extends AbstractComponent {

  /**
   *
   * @var BarContentArea 
   */
  private $leftArea;

  /**
   *
   * @var BarContentArea 
   */
  private $rightArea;

  /**
   * Constructs a new instance
   *
   * @param string $tagname
   * @param BarContentAreaInterface $left
   * @param BarContentAreaInterface $right
   */
  public function __construct($tagname, BarContentAreaInterface $left, BarContentAreaInterface $right) {
    parent::__construct($tagname);
    $this->leftArea = $left;
    $this->rightArea = $right;
  }

  public function __destruct() {
    unset($this->leftArea, $this->rightArea);
    parent::__clone();
  }

  public function __clone() {
    $this->leftArea = clone $this->leftArea;
    $this->rightArea = clone $this->rightArea;
    parent::__clone();
  }

  /**
   * Sets and Returns the left side menu area component
   *
   * @return BarContentAreaInterface the left side menu area component
   */
  public function left() {
    return $this->leftArea;
  }

  /**
   * Sets and Returns the right side menu area component
   *
   * @return BarContentAreaInterface the right side menu area component
   */
  public function right() {
    return $this->rightArea;
  }

  public function contentToString(): string {
    return $this->leftArea->getHtml() . $this->rightArea->getHtml();
  }

}
