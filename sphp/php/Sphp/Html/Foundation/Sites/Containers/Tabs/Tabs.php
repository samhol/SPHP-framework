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
use Traversable;

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
   * @var TabContentContainer 
   */
  private $tabs;

  /**
   * @var TabContentContainer 
   */
  private $tabsContent;

  /**
   * Constructor
   * 
   * @param TabControllerContainer $tabControllers
   * @param TabContentContainer $content
   */
  public function __construct(TabControllerContainer $tabControllers = null, TabContentContainer $content = null) {
    if ($content === null) {
      $content = new TabContentContainer();
    }
    $this->tabsContent = $content;
    if ($tabControllers === null) {
      $tabControllers = new TabControllerContainer();
    }
    $this->tabs = $tabControllers;
    $this->tabsContent->attributes()->setAttribute('data-tabs-content', $this->tabs->identify());
  }

  /**
   * Appends the given tab instance to the container
   * 
   * @param  TabInterface $tab the tab instance
   * @return $this for a fluent interface
   */
  public function append(TabInterface $tab) {
    $this->tabsContent->append($tab);
    $this->tabs->append($tab->getTabButton());
    return $this;
  }

  /**
   * Appends a new tab into the container
   *
   * @param  mixed $title the label of the tab button
   * @param  mixed $content the content of the tab
   * @return Tab the new appended tab 
   */
  public function appendTab($title, $content = null): Tab {
    $tab = new Tab($title, $content);
    $this->append($tab);
    return $tab;
  }

  /**
   * Checks if a tab exists in the given index
   * 
   * @param  int $index the index to check for
   * @return boolean true if a tab exits at the given index
   */
  public function hasTab(int $index): bool {
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
    return $this->tabs->getHtml() . $this->tabsContent->getHtml();
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
    if (!$this->hasTab($index)) {
      throw new OutOfBoundsException("Tab at $index does not exist");
    }
    $tab = $this->getTab($index);
    $tab->setActive(true);
    return $this;
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->tabsContent->getIterator();
  }

}
