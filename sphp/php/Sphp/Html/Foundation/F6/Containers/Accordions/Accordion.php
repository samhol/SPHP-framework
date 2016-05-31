<?php

/**
 * Accordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Accordions;

use Sphp\Html\AbstractComponent as AbstractComponent;

/**
 * Class implements an Foundation 6 Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-12-01
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Accordion extends AbstractComponent implements \IteratorAggregate {

  /**
   * Constructs a new instance
   *
   * @param null|Pane|Pane[] $content the value of the target attribute
   */
  public function __construct($content = null) {
    parent::__construct("ul");
    $this->cssClasses()->lock("accordion");
    $this->attrs()->demand("data-accordion");
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
   * @return self for PHP Method Chaining
   */
  public function prepend(PaneInterface $pane) {
    $this->content()->prepend($pane);
    return $this;
  }

  /**
   * Creates and prepends a new pane component into the accordion
   * 
   * @param  mixed $title the content of the pane title
   * @param  mixed $content the content of the actual pane
   * @return self for PHP Method Chaining
   */
  public function prependPane($title, $content) {
    $this->content()->prepend(new Pane($title, $content));
    return $this;
  }

  /**
   * Appends a pane component into the accordion
   * 
   * @param  PaneInterface $pane added pane component
   * @return self for PHP Method Chaining
   */
  public function append(PaneInterface $pane) {
    $this->content()->append($pane);
    return $this;
  }

  /**
   * Creates appends a new pane component into the accordion
   * 
   * @param  mixed $title the content of the pane title
   * @param  mixed $content the content of the actual pane
   * @return self for PHP Method Chaining
   */
  public function appendPane($title, $content) {
    $this->content()->append(new Pane($title, $content));
    return $this;
  }

  /**
   * Create a new iterator to iterate through inserted {@link Accordion} components 
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * Sets the amount of time to animate the opening of an accordion pane
   * 
   * @param  int $speed
   * @return self for PHP Method Chaining
   */
  public function setSliderSpeed($speed) {
    $this->attrs()->set("data-slide-speed", $speed);
    return $this;
  }

  /**
   * Sets the amount of time to animate the opening of an accordion pane
   * 
   * @param  boolean $expand
   * @return self for PHP Method Chaining
   */
  public function allowMultiExpand($expand = true) {
    $value = $expand ? "true" : "false";
    $this->attrs()->set("data-multi-expand", $value);
    return $this;
  }

  /**
   * Sets the amount of time to animate the opening of an accordion pane
   * 
   * @param  boolean $allClosed
   * @return self for PHP Method Chaining
   */
  public function allowAllClosed($allClosed = true) {
    $value = $allClosed ? "true" : "false";
    $this->attrs()->set("data-allow-all-closed", $value);
    return $this;
  }

}
