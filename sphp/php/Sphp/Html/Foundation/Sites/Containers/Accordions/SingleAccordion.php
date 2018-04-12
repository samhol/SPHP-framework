<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerTag;

/**
 * Implements an Foundation Accordion containing a single pane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $this->cssClasses()->protect('accordion');
    $this->attributes()->demand('data-accordion');
  }

  /**
   * Returns the inner accordion component
   *
   * @return Pane the inner accordion component
   */
  protected function getPane() {
    return $this->getInnerContainer();
  }

  /**
   * Sets the title of the accordion pane
   *
   * @param  mixed|mixed[] $title the heading of the accordion
   * @return $this for a fluent interface
   */
  public function setPaneTitle($title) {
    $this->getPane()->setPaneTitle($title);
    return $this;
  }

  /**
   * Sets the visibility of the content after initialization
   *
   * @param  boolean $visibility true if the content is visible, false otherwise
   * @return $this for a fluent interface
   */
  public function contentVisible(bool $visibility = true) {
    $this->getPane()->contentVisible($visibility);
    return $this;
  }

  public function ajaxAppend(string $url) {
    $this->getPane()->ajaxAppend($url);
    return $this;
  }

  public function ajaxPrepend(string $url) {
    $this->getPane()->ajaxPrepend($url);
    return $this;
  }

}
