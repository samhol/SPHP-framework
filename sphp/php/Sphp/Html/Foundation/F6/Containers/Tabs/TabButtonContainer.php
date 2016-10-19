<?php

/**
 * TabButtonContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use OutOfBoundsException;

/**
 * Class TabTitleContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabButtonContainer extends AbstractContainerComponent implements TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('ul');
    $this->identify();
    $this->cssClasses()->lock('tabs');
    $this->attrs()->demand('data-tabs');
  }

  /**
   * 
   * @param TabButton $button
   */
  public function append(TabButton $button) {
    $this->getInnerContainer()->append($button);
    return $this;
  }

  /**
   * 
   * @param  int $index
   * @return boolean
   */
  public function hasButton($index) {
    return $this->getInnerContainer()->offsetExists($index);
  }

  /**
   * 
   * @param  int $index
   * @return Tab
   * @throws OutOfBoundsException
   */
  public function getButton($index) {
    if (!$this->hasButton($index)) {
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
  public function count() {
    return $this->getInnerContainer()->count();
  }

  /**
   * Sets/unsets the heights of the tab content panes to match
   * 
   * @param  boolean $match true for matching heights
   * @return self for PHP Method Chaining
   */
  public function matchHeight($match = true) {
    $value = $match ? 'true' : 'false';
    $this->attrs()->set('data-match-height', $value);
    return $this;
  }

  /**
   * 
   * @param  int $index
   * @throws OutOfBoundsException
   * @return self for PHP Method Chaining
   */
  public function setActive($index) {
    if (!$this->hasButton($index)) {
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
