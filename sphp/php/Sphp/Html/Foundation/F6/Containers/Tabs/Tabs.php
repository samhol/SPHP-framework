<?php

/**
 * Tabs.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\ContentInterface;

/**
 * Class implements Foundation Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tabs implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   *
   * @var TabContentContainer 
   */
  private $tabsContent;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->tabsContent = new TabContentContainer();
    //$this->tabs = $this->tabsContent->getTabButtons();
  }

  /**
   * Appends a new tab into the container
   *
   * @param  mixed $title the label of the tab button
   * @param  mixed $content the content of the tab
   * @return Tab the new appended tab 
   */
  public function appendTab($title, $content = null) {
    return $this->tabsContent->appendTab($title, $content);
  }
  /**
   * Checks if a tab exsts in the given index
   * 
   * @param  int $index the index to check
   * @return boolean true if a tab exits at the given index
   */
  public function hasTab($index) {
    return $this->tabsContent->hasTab($index);
  }

  /**
   * 
   * @param  int $index
   * @return Tab
   * @throws OutOfBoundsException
   */
  public function getTab($index) {
    return $this->tabsContent->getTab($index);
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->tabsContent->getTabButtons() . $this->tabsContent;
  }

  /**
   * Sets/unsets the heights of the tab content panes to match
   * 
   * @param  boolean $match true for matching heights
   * @return self for PHP Method Chaining
   */
  public function matchHeight($match = true) {
    $this->tabsContent->matchHeight($match);
    return $this;
  }

  /**
   * 
   * @param  int $index
   * @return self for PHP Method Chaining
   */
  public function activate($index) {
    $this->tabsContent->setActive($index);
    return $this;
  }

}
