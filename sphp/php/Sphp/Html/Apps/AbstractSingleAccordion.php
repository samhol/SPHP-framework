<?php

/**
 * AbstractSingleAccordion (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\Div as Div;
use Sphp\Html\Span as Span;

/**
 * Class implements a single accordion component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-26
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractSingleAccordion extends AbstractComponent {

  /**
   * Constructs a new instance
   *
   * @param mixed $heading optional heading of the accordion
   * @param ComponentInterface $contentContainer optional content container of the accordion
   */
  public function __construct($wrapperTagname = Div::TAG_NAME, $heading = null, ComponentInterface $contentContainer = null) {
    parent::__construct($wrapperTagname);
    $this->content()["head"] = new Div();
    $this->head()->cssClasses()->lock("head");
    $this->head()["title"] = new Span($heading);
    if ($contentContainer === null) {
      $this->content()["body"] = new Div($contentContainer);
    } else {
      $this->content()["body"] = $contentContainer;
    }
    $this->body()->cssClasses()->lock("body");
    $this->body()->setStyle("display", "none");
    $this->attrs()->demand("data-sphp-single-accordion");
  }

  /**
   * Returns the head section of the accoordion
   *
   * @return Span the head section of the accoordion
   */
  protected function head() {
    return $this->content("head");
  }

  /**
   * Returns the body section of the accoordion
   *
   * @return ComponentInterface the body section of the accoordion
   */
  protected function body() {
    return $this->content("body");
  }

  /**
   * Sets the heading of the accordion
   *
   * @param  mixed|mixed[] $heading the heading of the accordion
   * @return self for PHP Method Chaining
   */
  public function setHeading($heading) {
    $this->content()["head"]["title"]->replaceContent($heading);
    return $this;
  }

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  boolean $visibility true if the content is visible, false otherwise
   * @return self for PHP Method Chaining
   */
  public function contentVisible($visibility = true) {
    if ($visibility) {
      $this->head()->removeCssClass("inactive")
              ->addCssClass("active");
    } else {
      $this->head()->removeCssClass("active")
              ->addCssClass("inactive");
    }
    return $this;
  }

}
