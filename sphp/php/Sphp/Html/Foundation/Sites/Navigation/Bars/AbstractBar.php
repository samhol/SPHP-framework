<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\AbstractComponent;

/**
 * Implements an abstract Foundation Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
   *
   * @param string $tagname
   * @param BarContentArea $left
   * @param BarContentArea $right
   */
  public function __construct(string $tagname, BarContentArea $left, BarContentArea $right) {
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
   * Returns the left side menu area component
   *
   * @return BarContentArea the left side menu area component
   */
  public function left(): BarContentArea {
    return $this->leftArea;
  }

  /**
   * Returns the right side menu area component
   *
   * @return BarContentArea the right side menu area component
   */
  public function right(): BarContentArea {
    return $this->rightArea;
  }

  public function contentToString(): string {
    return $this->leftArea->getHtml() . $this->rightArea->getHtml();
  }

}
