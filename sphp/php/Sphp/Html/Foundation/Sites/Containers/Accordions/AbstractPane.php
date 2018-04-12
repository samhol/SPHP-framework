<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\ContainerTag;
use Sphp\Html\Div;

/**
 * Class AbstractPane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $div->attributes()->demand('data-tab-content');
    $div->cssClasses()->protect('accordion-content');
    parent::__construct('li', null, $div);
    $this->bar = (new ContainerTag('a', $barContent));
    $this->bar->cssClasses()->protect("accordion-title");
    $this->bar->attributes()->protect('href', '#');
    $this->cssClasses()->protect('accordion-item');
    $this->attributes()->demand('data-accordion-item');
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

  public function contentVisible(bool $visibility = true) {
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
