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

use Sphp\Bootstrap\Layout\AbstractCol;
use Sphp\Html\Forms\Inputs\ValidableInput;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Html\Tags;
use Sphp\Html\Forms\Inputs\InputFactory;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;

/**
 * The ValidableInputCol class
 * 
 * @method static self text(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method static \Sphp\Html\Forms\Inputs\SearchInput textarea(?string $name = null, $for = null) creates an instance of Search Input
 * @method static self number(mixed $content = null, $for = null) creates a &lt;input type=text&gt; object
 * @method static \Sphp\Html\Forms\Inputs\Radiobox radio(mixed $content = null, $for = null) creates a &lt;input type=radio&gt; object
 * @method static \Sphp\Html\Forms\Inputs\SearchInput search(?string $name = null, $for = null) creates an instance of Search Input
 * @method static \Sphp\Html\Forms\Inputs\Menus\Select select(?string $name = null, ?iterable $options = null) creates an instance of Search Input
 * 
 * @method type methodName(type $paramName) Description
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ValidableInputCol extends AbstractCol {

  private ValidableInput $input;
  private Label $label;
  private ?string $validTooltip = null;
  private ?string $invalidTooltip = null;
  private bool $floatLabels = false;

  /**
   * Constructor
   * 
   * @param ValidableInput $input
   * @param string|null $label
   */
  public function __construct(ValidableInput $input, ?string $label = null) {
    parent::__construct();
    //$this->addCssClass('position-relative');
    $this->label = new Label($label, $input);
    if ($input instanceof Select) {
      $input->addCssClass('form-select');
      $this->label->addCssClass('form-label');
    } else if ($input instanceof Choicebox) {
      $input->addCssClass('form-check-input');
      $this->label->addCssClass('form-check-label');
    } else {
      $input->addCssClass('form-control');
      $this->label->addCssClass('form-label');
    }
    $this->input = $input;

    //$this->input->addCssClass('form-control');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->input, $this->formLabel);
  }

  /**
   * 
   * @param  string|null $label
   * @return $this for a fluent interface
   */
  public function setFloatingLabel(?string $label) {
    if ($label !== null) {
      $this->floatLabels = true;
      $this->setLabelText($label);
      $this->input->setPlaceHolder($label);
    } else {
      $this->floatLabels = false;
    }

    //$this->label->removeCssClass('form-label');
    return $this;
  }

  public function getInput(): ValidableInput {
    return $this->input;
  }

  /**
   * Sets the label text
   * 
   * @param  string|null $text label text
   * @return $this for a fluent interface
   */
  public function setLabelText(?string $text) {
    $this->label->resetContent($text);
    return $this;
  }

  public function getLabel(): Label {
    return $this->label;
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

  public function setRequired(bool $required) {
    $this->input->setRequired($required);
    return $this;
  }

  public function contentToString(): string {
    $out = '';
    if ($this->floatLabels) {
      $out = '<div class="form-floating">';
      $out .= (string) $this->input;
      $out .= (string) $this->label;
    } else {
      $out .= (string) $this->label;
      $out .= (string) $this->input;
    }
    if ($this->invalidTooltip !== null) {
      $out .= Tags::div($this->invalidTooltip)->addCssClass('invalid-feedback');
    } if ($this->validTooltip !== null) {
      $out .= Tags::div($this->validTooltip)->addCssClass('valid-feedback');
    }
    if ($this->input instanceof \Sphp\Html\Forms\Inputs\Choicebox) {
      $out = '<div class="form-check">' . $out . '</div>';
    }
    if ($this->floatLabels) {
      $out .= '</div>';
    }
    return $out;
  }

  public static function __callStatic(string $name, array $args): ValidableInputCol {
    $col = new ValidableInputCol(InputFactory::$name(...$args));
    return $col;
  }

}
