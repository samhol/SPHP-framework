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
use Sphp\Html\Foundation\Sites\Controllers\MenuButton;
/**
 * Implements a responsive Foundation bar container
 *
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/kitchen-sink.html#title-bar Foundation Title Bar
 * @link    https://foundation.zurb.com/sites/docs/kitchen-sink.html#top-bar Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ResponsiveBar extends AbstractComponent {

  /**
   * @var TitleBar 
   */
  private $titleBar;

  /**
   * @var TopBar 
   */
  private $topBar;

  /**
   * Constructor
   * 
   * @param TitleBar $titleBar
   * @param TopBar $topBar
   */
  public function __construct(TitleBar $titleBar = null, TopBar $topBar = null) {
    parent::__construct('div');
    $this->cssClasses()
            ->add('no-js')
            ->protectValue('sphp', 'responsive-bar-container');
    if ($titleBar === null) {
      $titleBar = new TitleBar();
    }
    if ($topBar === null) {
      $topBar = new TopBar();
    }
    $this->titleBar = $titleBar;
    $this->topBar = $topBar;
    $this->pairBars();
  }

  public function __destruct() {
    unset($this->titleBar, $this->topBar);
    parent::__destruct();
  }

  protected function pairBars() {
    $id = $this->topbar()->identify();
    $this->titleBar->attributes()->setAttribute('data-responsive-toggle', $id)->setAttribute('data-hide-for', 'medium');
    $this->titleBar->left()->append((new MenuButton('Open left menu'))->setAttribute('data-toggle', true));
  }

  /**
   * Returns the title bar component
   * 
   * @return TitleBar the title bar component
   */
  public function titleBar(): TitleBar {
    return $this->titleBar;
  }

  /**
   * Returns the top bar component
   * 
   * @return TopBar the top bar component
   */
  public function topbar(): TopBar {
    return $this->topBar;
  }

  public function contentToString(): string {
    return $this->titleBar->getHtml() . $this->topBar->getHtml();
  }

}
