<?php

/**
 * Accordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableContent;
use ArrayIterator;

/**
 * Implements an Foundation 6 Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Accordion extends AbstractContainerComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * @param null|Pane|Pane[] $content the value of the target attribute
   */
  public function __construct($content = null) {
    parent::__construct('ul');
    $this->cssClasses()->protect('accordion');
    $this->attributes()->demand('data-accordion');
    if ($content !== null) {
      foreach (is_array($content) ? $content : [$content] as $c) {
        $this->append($c);
      }
    }
  }

  /**
   * Prepends a pane component into the accordion
   * 
   * @param  PaneInterface $pane added component
   * @return $this for a fluent interface
   */
  public function prepend(PaneInterface $pane) {
    $this->getInnerContainer()->prepend($pane);
    return $this;
  }

  /**
   * Creates and prepends a new pane component into the accordion
   * 
   * @param  mixed $title the content of the pane title
   * @param  mixed $content the content of the actual pane
   * @return $this for a fluent interface
   */
  public function prependPane($title, $content) {
    $this->getInnerContainer()->prepend(new Pane($title, $content));
    return $this;
  }

  /**
   * Appends a pane component into the accordion
   * 
   * @param  PaneInterface $pane added pane component
   * @return $this for a fluent interface
   */
  public function append(PaneInterface $pane) {
    $this->getInnerContainer()->append($pane);
    return $this;
  }

  /**
   * Creates and appends a new {@link Pane} component into the accordion
   * 
   * @param  mixed $title the content of the pane title
   * @param  mixed $content the content of the actual pane
   * @return $this for a fluent interface
   */
  public function appendPane($title, $content) {
    $this->getInnerContainer()->append(new Pane($title, $content));
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
  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  /**
   * Sets the amount of time to animate the opening of an accordion pane
   * 
   * @param  int $speed the amount of time
   * @return $this for a fluent interface
   */
  public function setSliderSpeed(int $speed) {
    $this->attributes()->set('data-slide-speed', $speed);
    return $this;
  }

  /**
   * Sets whether to allow the accordion to have multiple open panes
   * 
   * @param  boolean $allow true for allowing and false otherwise
   * @return $this for a fluent interface
   */
  public function allowMultiExpand(bool $allow = true) {
    $value = $allow ? 'true' : 'false';
    $this->attributes()->set('data-multi-expand', $value);
    return $this;
  }

  /**
   * Sets whether to allow the accordion to close all panes
   * 
   * @param  boolean $allow true for allowing and false otherwise
   * @return $this for a fluent interface
   */
  public function allowAllClosed(bool $allow = true) {
    $value = $allow ? 'true' : 'false';
    $this->attributes()->set('data-allow-all-closed', $value);
    return $this;
  }

}
