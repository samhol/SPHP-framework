<?php

/**
 * Pane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\AjaxLoader as AjaxLoaderInterface;
use Sphp\Html\ContainerTag;
use Sphp\Html\Div;

/**
 * Implements a Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Pane extends AbstractContainerTag implements PaneInterface, AjaxLoaderInterface {

  /**
   * The title component of the pane
   *
   * @var ContainerTag
   */
  private $bar;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameters `$title` and `$content` can be of any type that converts to a PHP
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param null|mixed $title the content of the pane title
   * @param null|mixed $content the content of the actual pane
   */
  public function __construct($title = null, $content = null) {
    $div = new Div($content);
    $div->attrs()->demand('data-tab-content');
    $div->cssClasses()->protect('accordion-content');
    parent::__construct('li', null, $div);
    $this->bar = (new ContainerTag('a', $title));
    $this->bar->cssClasses()->protect('accordion-title');
    $this->bar->attrs()->protect('href', '#');
    $this->cssClasses()->protect('accordion-item');
    $this->attrs()->demand('data-accordion-item');
  }

  /**
   * Returns the inner title area of the accordion pane
   *
   * @return ContainerTag the inner title area of the accordion pane
   */
  public function getBar() {
    return $this->bar;
  }

  public function setPaneTitle($title) {
    $this->bar->replaceContent($title);
    return $this;
  }

  public function contentVisible(bool $visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }

  public function contentToString(): string {
    return $this->bar->getHtml() . parent::contentToString();
  }

  public function ajaxAppend(string $url) {
    $this->getInnerContainer()->ajaxAppend($url);
    return $this;
  }

  public function ajaxPrepend(string $url) {
    $this->getInnerContainer()->ajaxPrepend($url);
    return $this;
  }

}
