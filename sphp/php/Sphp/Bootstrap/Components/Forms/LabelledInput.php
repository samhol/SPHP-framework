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
use Sphp\Html\Text\Span;
use Sphp\Html\Component;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\InputFactory;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;
use Sphp\Html\Tags;

/**
 * The InputGroup class
 * 
 * @method static self text(mixed $content = null, $for = null) creates a text input
 * @method static self search(mixed $content = null, $for = null) creates a search input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LabelledInput extends AbstractComponent {

  private PlainContainer $container;
  private Input $input;
  private ?string $validTooltip = null;
  private ?string $invalidTooltip = null;

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

  /**

    /**
   * 
   * @param  string|null $toolTip
   * @return $this for a fluent interface
   */
  public function setValidTooltip(?string $toolTip) {
    $this->validTooltip = $toolTip;
    return $this;
  }

  /**
   * 
   * @param  string|null $toolTip
   * @return $this for a fluent interface
   */
  public function setInvalidToolTip(?string $toolTip) {
    $this->invalidTooltip = $toolTip;
    return $this;
  }

  /**
   * 
   * @param  bool $required
   * @return $this for a fluent interface
   */
  public function setRequired(bool $required) {
    $this->input->setRequired($required);
    return $this;
  }

  public function contentToString(): string {
    $out = $this->container->getHtml();
    if ($this->invalidTooltip !== null) {
      $out .= Tags::div($this->invalidTooltip)->addCssClass('invalid-feedback');
    } if ($this->validTooltip !== null) {
      $out .= Tags::div($this->validTooltip)->addCssClass('valid-feedback');
    }
    return $out;
  }

  /**
   * 
   * @param  string $name
   * @param  array $args
   * @return LabelledInput
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $args): LabelledInput {
    try {
      return new LabelledInput(InputFactory::$name(...$args));
    } catch (\Error $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
