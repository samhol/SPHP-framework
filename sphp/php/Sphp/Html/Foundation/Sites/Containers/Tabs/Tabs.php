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
use Sphp\Html\Lists\Ul;
use Sphp\Html\Div;
use Sphp\Html\TraversableContent;
use OutOfBoundsException;
use Traversable;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

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
   * @var Tab[] 
   */
  private $tabs = [];

  /**
   * @var Div 
   */
  private $content;

  /**
   * @var Ul 
   */
  private $controllers;

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  /**
   * Constructor
   */
  public function __construct() {
    $this->controllers = new Ul();
    $this->controllers->identify();
    $this->controllers->cssClasses()->protectValue('tabs');
    $this->controllers->attributes()->demand('data-tabs');
    $this->content = new Div();
    $this->content->attributes()->setAttribute('data-tabs-content', $this->controllers->identify());
    $this->controllers->attributes()->setInstance($this->options = new PropertyCollectionAttribute('data-options'));
  }

  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $this->options->setProperty($name, $value);
    return $this;
  }

  /**
   * Appends the given tab instance to the container
   * 
   * @param  Tab $tab the tab instance
   * @return $this for a fluent interface
   */
  public function append(Tab $tab) {
    $this->tabs[] = $tab;
    return $this;
  }

  /**
   * Appends a new tab into the container
   *
   * @param  mixed $title the label of the tab button
   * @param  mixed $content the content of the tab
   * @return DivTab the new appended tab 
   */
  public function appendTab($title, $content = null): DivTab {
    $tab = new DivTab($title, $content);
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
    return array_key_exists($index, $this->tabs);
    //return $this->tabsContent->hasTab($index);
  }

  /**
   * Returns the tab at specified index
   * 
   * @param  int $index the index to retrieve
   * @return Tab the tab at the given index
   * @throws OutOfBoundsException if the index is not set
   */
  public function getTab(int $index) {
    if ($this->hasTab($index)) {
      return $this->tabs[$index];
    }
    return null;
  }

  public function getHtml(): string {
    foreach ($this->tabs as $tab) {
      $this->controllers->append($tab->getTabButton());
      $this->content->append($tab);
    }
    return $this->controllers->getHtml() . $this->content->getHtml();
  }

  /**
   * Sets/unsets the heights of the tab content panes to match
   * 
   * @param  boolean $match true for matching heights
   * @return $this for a fluent interface
   */
  public function matchHeight(bool $match = true) {
    $this->setOption('matchHeight', $match);
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
