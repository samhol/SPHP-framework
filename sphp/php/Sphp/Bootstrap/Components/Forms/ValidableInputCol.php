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
use Sphp\Html\Forms\Label;
use Sphp\Html\Tags;
use Sphp\Html\Forms\Inputs\InputFactory;
use Sphp\Html\Forms\Inputs\TextInput;

/**
 * The ValidableInputCol class
 * 
 * @method static self text(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
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
  private ?string $validTooltip = null;
  private ?string $invalidTooltip = null;
  private Label $label;

  /**
   * Constructor
   * 
   * @param ValidableInput $input
   * @param string|null $label
   */
  public function __construct(ValidableInput $input, ?string $label = null) {
    parent::__construct();
    $this->addCssClass('position-relative');
    if ($input instanceof Select) {
      $input->addCssClass('form-select');
    } else {
      $input->addCssClass('form-control');
    }
    $this->input = $input;

    $this->input->addCssClass('form-control');
    $this->label = new Label($label, $input);
    $this->label->addCssClass('form-label');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->input, $this->formLabel);
  }

  public function getInput(): ValidableInput {
    return $this->input;
  }

  /**
   * 
   * @param  string|null $text
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
    $this->input->setRequired();
    return $this;
  }

  public function contentToString(): string {
    $out = (string) $this->label;
    $out .= (string) $this->input;
    if ($this->invalidTooltip !== null) {
      $out .= Tags::div($this->invalidTooltip)->addCssClass('invalid-tooltip');
    } if ($this->validTooltip !== null) {
      $out .= Tags::div($this->validTooltip)->addCssClass('valid-tooltip');
    }
    return $out;
  }

  public static function __callStatic(string $name, array $args): ValidableInputCol {
    $col = new ValidableInputCol(InputFactory::$name(...$args));
    return $col;
  }

}
