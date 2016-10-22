<?php

/**
 * SingleAccordion (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerTag;

/**
 * Class implements an Foundation 6 Accordion containing a single pane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SingleAccordion extends AbstractContainerTag {

  /**
   * Constructs a new instance
   *
   * @param null|mixed $paneTitle the content of the accordion bar
   * @param null|mixed $paneContent the content of the accordion container
   */
  public function __construct($paneTitle = null, $paneContent = null) {
    $pane = new Pane($paneTitle, $paneContent);
    parent::__construct('ul', null, $pane);
    $this->cssClasses()->lock('accordion');
    $this->attrs()->demand('data-accordion');
  }

  /**
   * Returns the inner accoordion component
   *
   * @return Pane the inner accoordion component
   */
  protected function getPane() {
    return $this->getInnerContainer();
  }

  /**
   * Sets the title of the accordion pane
   *
   * @param  mixed|mixed[] $title the heading of the accordion
   * @return self for PHP Method Chaining
   */
  public function setPaneTitle($title) {
    $this->getPane()->setPaneTitle($title);
    return $this;
  }

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  boolean $visibility true if the content is visible, false otherwise
   * @return self for PHP Method Chaining
   */
  public function contentVisible($visibility = true) {
    $this->getPane()->contentVisible($visibility);
    return $this;
  }

  public function ajaxAppend($url) {
    $this->getPane()->ajaxAppend($url);
    return $this;
  }

  public function ajaxPrepend($url) {
    $this->getPane()->ajaxPrepend($url);
    return $this;
  }

}
