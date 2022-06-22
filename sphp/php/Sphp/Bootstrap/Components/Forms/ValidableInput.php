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
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\ValidableInput as Inp;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\InputFactory;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;
use Sphp\Html\Tags;

/**
 * The InputGroup class
 *
 * 
 * @method static self text(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method static self search(mixed $content = null, $for = null) creates a search input
 * @method static self number(mixed $content = null, $for = null) creates a number input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ValidableInput extends AbstractComponent {

  private ?Label $label = null;
  private ?Label $pre = null;
  private Inp $input;
  private ?Label $post = null;
  private ?string $validTooltip = null;
  private ?string $invalidTooltip = null;

  /**
   * Constructor
   *
   * @param Input|null $input
   */
  public function __construct(Inp $input) {
    parent::__construct('div');
    if ($input instanceof Select) {
      $input->addCssClass('form-select');
    } else {
      $input->addCssClass('form-control');
    }
    $this->input = $input;
    $this->cssClasses()->protectValue('input-group has-validation');
  }

  public function getInput(): Inp {
    return $this->input;
  }

  public function setRequired(bool $required) {
    $this->input->setRequired($required);
    return $this;
  }

  public function setLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('form-label');
    $this->label = $label;
    return $label;
  }

  public function setPreLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->pre = $label;
    return $label;
  }

  public function setPostLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->post = $label;
    return $label;
  }

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

  public function contentToString(): string {
    $out = $this->pre . $this->input . $this->post;
    if ($this->invalidTooltip !== null) {
      $out .= Tags::div($this->invalidTooltip)->addCssClass('invalid-feedback');
    } if ($this->validTooltip !== null) {
      $out .= Tags::div($this->validTooltip)->addCssClass('valid-feedback');
    }
    return $out;
  }

  public function getHtml(): string {
    return $this->label . parent::getHtml();
  }

  /**
   * 
   * @param  string $name
   * @param  array $args
   * @return ValidableInput
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $args): ValidableInput {
    try {
      return new ValidableInput(InputFactory::$name(...$args));
    } catch (\Error $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
