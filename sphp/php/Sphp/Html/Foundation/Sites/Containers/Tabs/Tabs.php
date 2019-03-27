<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Core\JavaScript\JavaScriptComponent;
use Sphp\Html\Foundation\Sites\Core\DataOptions\DataOptionTools;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Div;
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
class Tabs extends AbstractContent implements JavaScriptComponent, IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

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

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->controllers, $this->content, $this->options);
  }
 public function setOption(string $name, $value) {
    $optionName = DataOptionTools::toOptionName($name);
    $optionValue = DataOptionTools::parseValue($value);
    $this->options->setProperty($optionName, $optionValue);
    return $this;
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
   * Appends the given tab instance to the container
   * 
   * @param  Tab $tab the tab instance
   * @return $this for a fluent interface
   */
  public function append(Tab $tab) {
    $this->controllers->append($tab->getController());
    $this->content->append($tab);
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
    return $this->content->offsetExists($index);
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
      return $this->content[$index];
    }
    return null;
  }

  /**
   * 
   * 
   * @param  int $index of the Tab
   * @return $this for a fluent interface
   * @throws OutOfBoundsException if a Tab at $index does not exist
   */
  public function setActive(int $index) {
    if (!$this->hasTab($index)) {
      throw new OutOfBoundsException("Tab at $index does not exist");
    }
    foreach ($this->content as $pos => $tab) {
      if ($pos === $index) {
        $tab->setActive(true);
      } else {
        $tab->setActive(false);
      }
    }
    return $this;
  }

  public function getHtml(): string {
    return $this->controllers->getHtml() . $this->content->getHtml();
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->content->getIterator();
  }

}
