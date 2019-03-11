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
 * Implements a container for Foundation Tabs 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TabContentContainer extends \Sphp\Html\AbstractComponent {

  private $content;
  /**
   * Constructor
   * 
   * @param TabControllerContainer $tabs
   */
  public function __construct() {
    parent::__construct('div');
    
    $this->content = [];
    $this->cssClasses()->protectValue('tabs-content');
  }

  /**
   * Appends the given tab instance to the container
   * 
   * @param  TabInterface $tab the tab instance
   * @return $this for a fluent interface
   */
  public function append(TabInterface $tab) {
    $this->content[] = $tab;
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
  public function hasTab(int $index) {
    return $this->getInnerContainer()->offsetExists($index);
  }

  /**
   * Returns the tab at specified index
   * 
   * @param  int $index the index to retrieve
   * @return TabInterface the tab at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getTab(int $index) {
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
   * @return $this for a fluent interface
   */
  public function matchHeight(bool $match = true) {
    $value = $match ? 'true' : 'false';
    $this->attributes()->setAttribute('data-match-height', $value);
    $this->tabs->matchHeight($match);
    return $this;
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->getInnerContainer()->getIterator();
  }

  /**
   * 
   * @param  int $index the index of the tab
   * @throws OutOfBoundsException if the index is not set
   * @return $this for a fluent interface
   */
  public function setActive(int $index) {
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


  public function contentToString(): string {
    return implode($this->content);
  }

}
