<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AbstractComponent;
use Sphp\Html\ContainerTag;
use Sphp\Html\Div;
use Sphp\Html\ContainerComponent;

/**
 * Abstract implementation of an Accordion Pane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractPane extends AbstractComponent implements Pane {

  /**
   * The bar component of the pane
   *
   * @var ContainerTag
   */
  private $bar;

  /**
   * @var Div 
   */
  private $content;

  /**
   * Constructor
   * 
   * @param mixed $bar
   * @param mixed $content
   */
  public function __construct($bar = null, $content = null) {
    parent::__construct('li');
    $this->cssClasses()->protectValue('accordion-item');
    $this->attributes()->demand('data-accordion-item');
    $this->bar = new ContainerTag('a', $bar);
    $this->bar->cssClasses()->protectValue('accordion-title');
    //$this->bar->attributes()->protect('href', '#');
    $this->content = new Div($content);
    $this->content->attributes()->demand('data-tab-content');
    $this->content->cssClasses()->protectValue('accordion-content');
    $this->setDeepLinking();
  }

  public function __destruct() {
    unset($this->bar, $this->content);
    parent::__destruct();
  }

  protected function setDeepLinking() {
    $id = $this->content->identify();
    $this->bar->attributes()->protect('href', "#$id");
  }

  /**
   * Returns the inner title area of the accordion pane
   *
   * @return ContainerComponent the inner title area of the accordion pane
   */
  public function getBar(): ContainerComponent {
    return $this->bar;
  }

  public function setPaneTitle($title) {
    $this->bar->resetContent($title);
    return $this;
  }

  /**
   * Returns the inner content area of the accordion pane
   *
   * @return ContainerComponent the inner title area of the accordion pane
   */
  public function getContent(): ContainerComponent {
    return $this->content;
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
    return $this->bar->getHtml() . $this->content->getHtml();
  }

}
