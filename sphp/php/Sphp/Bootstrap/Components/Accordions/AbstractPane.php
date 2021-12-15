<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Accordions;

use Sphp\Html\AbstractContent;
use Sphp\Html\Div;
use Sphp\Html\ContainerComponent;
use Sphp\Html\Sections\Headings\H2;
use Sphp\Html\Forms\Buttons\Button;

/**
 * Abstract implementation of an Accordion Pane
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractPane extends AbstractContent implements Pane {

  /**
   * @var Div
   */
  private Div $div;

  /**
   * The bar component of the pane
   *
   * @var H2
   */
  private H2 $bar;

  /**
   * @var Div 
   */
  private Div $content;

  /**
   * Constructor
   * 
   * @param mixed $bar
   * @param mixed $content
   */
  public function __construct($bar = null, $content = null) {
    $this->div = new Div();
    $this->div->addCssClass('accordion-item');
    $this->buildContent($bar, $content);
    // $this->setDeepLinking();
  }

  public function __destruct() {
    unset($this->div, $this->bar, $this->body, $this->content);
  }

  public function setAccordionParent(Accordion $accordion) {
    $this->content->setAttribute('data-bs-parent', "#{$accordion->identify()}");
    return $this;
  }

  protected function buildContent($bar, $content) {
    $this->bar = $this->div->appendH2();
    $this->bar->identify();
    $this->bar->addCssClass('accordion-header');
    $this->button = new Button($bar);
    $this->button->addCssClass('accordion-button collapsed');
    $this->button->setAttribute('data-bs-toggle', 'collapse');
    $this->content = $this->div->appendDiv();
    $id = $this->content->identify();
    $this->button->setAttribute('data-bs-target', "#$id");
    $this->button->setAttribute('aria-expanded', "false");
    $this->button->setAttribute('aria-controls', "$id");
    $this->bar->append($this->button);

    $this->content->addCssClass('accordion-collapse collapse');
    $this->body = $this->content->appendDiv($content);
    $this->body->addCssClass('accordion-body');
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
    $this->button->resetContent($title);
    return $this;
  }

  /**
   * Returns the inner content area of the accordion pane
   *
   * @return ContainerComponent the inner title area of the accordion pane
   */
  public function getContent(): ContainerComponent {
    return $this->body;
  }

  public function contentVisible(bool $visibility = true) {
    if ($visibility) {
      $this->content->addCssClass('show');
      $this->button->removeCssClass('collapsed');
      $this->button->setAttribute('aria-expanded', 'true');
    } else {
      $this->content->removeCssClass('show');
      $this->button->addCssClass('collapsed');
      $this->button->setAttribute('aria-expanded', 'false');
    }
    return $this;
  }

  public function getHtml(): string {
    return $this->div->getHtml();
  }

}
