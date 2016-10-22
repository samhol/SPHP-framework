<?php

/**
 * TabContentContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use OutOfBoundsException;

/**
 * Class implements a container for Foundation Tabs 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TabContentContainer extends AbstractContainerComponent implements TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   *
   * @var TabControllerContainer
   */
  private $tabs;

  /**
   * Constructs a new instance
   * 
   * @param TabControllerContainer $tabs
   */
  public function __construct(TabControllerContainer $tabs = null) {
    parent::__construct('div');
    if ($tabs === null) {
      $tabs = new TabControllerContainer();
    }
    $this->tabs = $tabs;
    $this->cssClasses()->lock('tabs-content');
    $this->attrs()->set('data-tabs-content', $this->tabs->identify());
  }

  /**
   * Appends the given tab instance to the container
   * 
   * @param  TabInterface $tab the tab instance
   * @return self for PHP Method Chaining
   */
  public function append(TabInterface $tab) {
    $this->getInnerContainer()->append($tab);
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
  public function appendTab($title, $content = null) {
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
  public function hasTab($index) {
    return $this->getInnerContainer()->offsetExists($index);
  }

  /**
   * Returns the tab at specified index
   * 
   * @param  int $index the index to retrieve
   * @return TabInterface the tab at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getTab($index) {
    if (!$this->hasTab($index)) {
      throw new OutOfBoundsException("Tab at $index does not exist");
    }
    return $this->getInnerContainer()->offsetGet($index);
  }

  /**
   * 
   * @return TabControllerContainer
   */
  public function getTabButtons() {
    return $this->tabs;
  }

  /**
   * 
   * @param  boolean $match
   * @return self for PHP Method Chaining
   */
  public function matchHeight($match = true) {
    $value = $match ? 'true' : 'false';
    $this->attrs()->set('data-match-height', $value);
    $this->tabs->matchHeight($match);
    return $this;
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
   * 
   * @param  int $index the index of the tab
   * @throws OutOfBoundsException if the index is not set
   * @return self for PHP Method Chaining
   */
  public function setActive($index) {
    if (!$this->hasTab($index)) {
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
