<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Implements a Title Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TitleBar extends \Sphp\Html\AbstractComponent {

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
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protect('title-bar');
    $this->leftArea = new TitleBarContentArea('left');
    $this->rightArea = new TitleBarContentArea('right');
  }

  public function __destruct() {
    unset($this->leftArea, $this->rightArea);
    parent::__destruct();
  }

  public function __clone() {
    $this->leftArea = clone $this->leftArea;
    $this->rightArea = clone $this->rightArea;
    parent::__clone();
  }

  /**
   * Sets and Returns the left side menu area component
   *
   * @return TitleBarContentArea the left side menu area component
   */
  public function left(): TitleBarContentArea {
    return $this->leftArea;
  }

  /**
   * Sets and Returns the right side menu area component
   *
   * @return TitleBarContentArea the right side menu area component
   */
  public function right(): TitleBarContentArea {
    return $this->rightArea;
  }

  public function contentToString(): string {
    return $this->leftArea->getHtml() . 'foo' . $this->rightArea->getHtml();
  }

}
