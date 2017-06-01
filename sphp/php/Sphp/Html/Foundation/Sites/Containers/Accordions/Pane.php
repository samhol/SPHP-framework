<?php

/**
 * Pane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\AjaxLoaderInterface as AjaxLoaderInterface;
use Sphp\Html\ContainerTag;
use Sphp\Html\Div;

/**
 * Implements a Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-13
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
    $div->cssClasses()->lock('accordion-content');
    parent::__construct('li', null, $div);
    $this->bar = (new ContainerTag('a', $title));
    $this->bar->cssClasses()->lock('accordion-title');
    $this->bar->attrs()->lock('href', '#');
    $this->cssClasses()->lock('accordion-item');
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

  /**
   * @inheritdoc
   */
  public function setPaneTitle($title) {
    $this->bar->replaceContent($title);
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function contentVisible($visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function contentToString(): string {
    return $this->bar->getHtml() . parent::contentToString();
  }

  /**
   * @inheritdoc
   */
  public function ajaxAppend($url) {
    $this->getInnerContainer()->ajaxAppend($url);
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function ajaxPrepend($url) {
    $this->getInnerContainer()->ajaxPrepend($url);
    return $this;
  }

}
