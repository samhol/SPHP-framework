<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use IteratorAggregate;
use Sphp\Html\Content;
use Sphp\Html\TraversableContent;
use OutOfBoundsException;

/**
 * Implements Foundation Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Tabs implements Content, IteratorAggregate, TraversableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   *
   * @var TabContentContainer 
   */
  private $tabsContent;

  /**
   * Constructor
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
  public function hasTab(int $index) {
    return $this->tabsContent->hasTab($index);
  }

  /**
   * Returns the tab at specified index
   * 
   * @param  int $index the index to retrieve
   * @return TabInterface the tab at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getTab(int $index) {
    return $this->tabsContent->getTab($index);
  }

  public function getHtml(): string {
    return $this->tabsContent->getTabButtons()->getHtml() . $this->tabsContent->getHtml();
  }

  /**
   * Sets/unsets the heights of the tab content panes to match
   * 
   * @param  boolean $match true for matching heights
   * @return $this for a fluent interface
   */
  public function matchHeight(bool $match = true) {
    $this->tabsContent->matchHeight($match);
    return $this;
  }

  /**
   * 
   * @param  int $index of the Tab
   * @return $this for a fluent interface
   */
  public function setActive(int $index) {
    $this->tabsContent->setActive($index);
    return $this;
  }

  /**
   * Count the number of inserted components in the container
   *
   * @return int number of components in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
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
