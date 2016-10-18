<?php

/**
 * TabContentContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use OutOfBoundsException;

/**
 * Description of TabContentContainer
 *
 * @author Sami Holck
 */
class TabContentContainer extends AbstractContainerComponent implements TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   *
   * @var TabButtonContainer
   */
  private $tabs;

  /**
   * Constructs a new instance
   * 
   * @param TabButtonContainer $tabs
   */
  public function __construct(TabButtonContainer $tabs = null) {
    parent::__construct('div');
    if ($tabs === null) {
      $tabs = new TabButtonContainer();
    }
    $this->tabs = $tabs;
    $this->cssClasses()->lock('tabs-content');
    $this->attrs()->set('data-tabs-content', $this->tabs->identify());
  }

  /**
   * Appends the given Tab instancce to the container
   * 
   * @param  Tab $tab
   * @return self for PHP Method Chaining
   */
  public function append(Tab $tab) {
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
   * @return Tab the tab at the given index
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
   * @return TabButtonContainer
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
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->getInnerContainer()->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->getInnerContainer()->count();
  }

  /**
   * 
   * @param  int $index
   * @throws OutOfBoundsException
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
