<?php

/**
 * TabButtonContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use OutOfBoundsException;

/**
 * Class TabTitleContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabControllerContainer extends AbstractContainerComponent implements IteratorAggregate, TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('ul');
    $this->identify();
    $this->cssClasses()->protect('tabs');
    $this->attrs()->demand('data-tabs');
  }


  /**
   * Appends the given tab controller instance to the container
   *
   * @param TabControllerInterface $controller the tab controller instance
   * @return TabControllerInterface
   */
  public function append(TabControllerInterface $controller) {
    $this->getInnerContainer()->append($controller);
    return $controller;
  }

  /**
   * Checks if a tab controller exists in the given index
   * 
   * @param  int $index the index to check for
   * @return boolean true if a tab controller exits at the given index
   */
  public function hasController(int $index) {
    return $this->getInnerContainer()->offsetExists($index);
  }


  /**
   * Returns the tab controller at specified index
   * 
   * @param  int $index the index to retrieve
   * @return TabControllerInterface the tab controller at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getController(int $index) {
    if (!$this->hasController($index)) {
      throw new OutOfBoundsException("Tab at $index does not exist");
    }
    return $this->getInnerContainer()->offsetGet($index);
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return ArrayIterator iterator
   */
  public function getIterator() {
    return $this->getInnerContainer()->getIterator();
  }

  /**
   * Count the number of inserted components in the container
   *
   * @return int number of components in the html component
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  /**
   * Sets/unsets the heights of the tab content panes to match
   * 
   * @param  boolean $match true for matching heights
   * @return $this for a fluent interface
   */
  public function matchHeight(bool $match = true) {
    $value = $match ? 'true' : 'false';
    $this->attrs()->set('data-match-height', $value);
    return $this;
  }

  /**
   * Sets/unsets active the tab controller at a given index
   * 
   * @param  int $index the index to to set
   * @return $this for a fluent interface
   * @throws OutOfBoundsException if the index is not set
   */
  public function setActive(int $index) {
    if (!$this->hasController($index)) {
      throw new OutOfBoundsException("Tab at $index does not exist");
    }
    foreach ($this as $i => $tab) {
      if ($i === $index) {
        $tab->setActive(true);
      } else {
        $tab->setActive(false);
      }
    }
  }

}
