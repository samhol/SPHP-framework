<?php

/**
 * AbstractPane.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\ContainerTag;
use Sphp\Html\Div;

/**
 * Class AbstractPane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-01-13
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPane extends AbstractContainerComponent implements PaneInterface {

  /**
   * The bar component of the pane
   *
   * @var ContainerTag
   */
  private $bar;
  
  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameters `$barContent` and `$content` can be of any type that converts to a PHP
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param null|mixed $barContent the content of the accordion bar
   * @param null|mixed $content the content of the accordion container
   */
  public function __construct($barContent = null, $content = null) {
    $div = new Div($content);
    $div->attrs()->demand('data-tab-content');
    $div->cssClasses()->lock('accordion-content');
    parent::__construct('li', null, $div);
    $this->bar = (new ContainerTag('a', $barContent));
    $this->bar->cssClasses()->lock("accordion-title");
    $this->bar->attrs()->lock('href', '#');
    $this->cssClasses()->lock('accordion-item');
    $this->attrs()->demand('data-accordion-item');
  }

  /**
   * Returns the inner heading component
   *
   * @return ContainerTag the inner heading component
   */
  public function getBar() {
    return $this->bar;
  }

  public function setPaneTitle($title) {
    $this->bar->replaceContent($title);
    return $this;
  }

  public function contentVisible($visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    return $this;
  }
  
  public function contentToString(): string {
    return $this->bar->getHtml() . $this->getInnerContainer()->getHtml();
  }

}
