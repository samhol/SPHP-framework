<?php

/**
 * Tabs.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\ContentInterface;
use Sphp\Html\TraversableInterface;
use OutOfBoundsException;

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
class Tabs implements ContentInterface, TraversableInterface {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

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
   * Checks if a tab exists in the given index
   * 
   * @param  int $index the index to check for
   * @return boolean true if a tab exits at the given index
   */
  public function hasTab($index) {
    return $this->tabsContent->hasTab($index);
  }

  /**
   * Returns the tab at specified index
   * 
   * @param  int $index the index to retrieve
   * @return TabInterface the tab at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getTab($index) {
    return $this->tabsContent->getTab($index);
  }

  public function getHtml() {
    return $this->tabsContent->getTabButtons()->getHtml() . $this->tabsContent->getHtml();
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
   * @param  int $index of the Tab
   * @return self for PHP Method Chaining
   */
  public function setActive($index) {
    $this->tabsContent->setActive($index);
    return $this;
  }

  /**
   * Count the number of inserted components in the container
   *
   * @return int number of components in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->tabsContent->count();
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return ArrayIterator iterator
   */
  public function getIterator() {
    return $this->tabsContent->getIterator();
  }

}
