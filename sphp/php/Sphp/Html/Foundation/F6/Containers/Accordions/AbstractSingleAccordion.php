<?php

/**
 * AbstractSingleAccordion (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Accordions;

use Sphp\Html\AbstractContainerComponent;

/**
 * Class implements a single accordion component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractSingleAccordion extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * @param null|mixed $title the content of the accordion bar
   * @param null|mixed $content the content of the accordion container
   */
  public function __construct(PaneInterface $innerAccordion = null) {
    if ($innerAccordion === null) {
      $innerAccordion = new Pane();
    }
    parent::__construct("ul");
    $this->cssClasses()->lock("accordion");
    $this->attrs()
            ->lock("data-allow-all-closed", "true")
            ->demand("data-accordion");
    $this->content()->set("innerAccordion", $innerAccordion);
  }

  /**
   * Returns the inner accoordion component
   *
   * @return Pane the inner accoordion component
   */
  protected function getAccordion() {
    return $this->content("innerAccordion");
  }

  /**
   * Sets the heading of the accordion
   *
   * @param  mixed|mixed[] $title the title of the accordion
   * @return self for PHP Method Chaining
   */
  public function setPaneTitle($title) {
    $this->getAccordion()->setPaneTitle($title);
    return $this;
  }

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  boolean $visibility true if the content is visible, false otherwise
   * @return self for PHP Method Chaining
   */
  public function contentVisible($visibility = true) {
    $this->getAccordion()->contentVisible($visibility);
    return $this;
  }

}
