<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Forms;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Component;
use Sphp\Html\Forms\Inputs\Menus\Select; 
/**
 * The InputGroup class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LabelledInput extends AbstractComponent {

  private PlainContainer $container;
  private Input $input;

  /**
   * Constructor
   *
   * @param Input|null $input
   */
  public function __construct(Input $input) {
    parent::__construct('div');
    $this->container = new PlainContainer;
    if ($input instanceof Select) {
      $input->addCssClass('form-select');
    } else {
      $input->addCssClass('form-control');
    }
    $this->container->append($input);
    $this->input = $input;
    $this->cssClasses()->protectValue('input-group');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->container, $this->input);
  }

  public function getInput(): Input {
    return $this->input;
  }

  public function prependText(string $content): Span {
    $label = new Span($content);
    $label->addCssClass('input-group-text');
    $this->container->prepend($label);
    return $label;
  }

  public function prependLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->container->prepend($label);
    return $label;
  }

  public function appendText($content): Span {
    $label = new Span($content);
    $label->addCssClass('input-group-text');
    $this->container->append($label);
    return $label;
  }

  public function appendLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->container->append($label);
    return $label;
  }

  public function prepend($content) {
    $this->container->prepend($content);
    return $this;
  }

  public function append($content) {
    $this->container->append($content);
    return $this;
  }

  public function appendButton(Component $button): Component {
    $button->addCssClass('btn');
    $this->container->append($button);
    return $button;
  }

  public function contentToString(): string {
    return $this->container->getHtml();
  }

  public static function __callStatic(string $name, array $args): LabelledInput {
    
  }

}
