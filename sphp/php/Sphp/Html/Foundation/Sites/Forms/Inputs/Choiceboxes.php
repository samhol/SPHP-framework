<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Grids\AbstractCell;
use Sphp\Html\Forms\Legend;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Foundation\Sites\Grids\Cell;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\FormControls;

/**
 * A component containing multiple radio or checkbox inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/forms.html#checkboxes-and-radio-buttons Foundation Checkboxes and Radio Buttons
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Choiceboxes extends AbstractCell implements Input, Cell {

  /**
   * @var string
   */
  private $type;

  /**
   * the type of the individual input component
   *
   * @var string
   */
  private $legend;

  /**
   * the name of the component
   *
   * @var string
   */
  private $name;

  /**
   * the options
   *
   * @var Input[]
   */
  private $options = [];

  /**
   * @var Label[]
   */
  private $labels = [];

  /**
   * Constructor
   *
   * @param string $type
   * @param string $name
   * @param array $values
   * @param mixed $legend
   */
  public function __construct(string $type, string $name = null, array $values = [], $legend = null) {
    $this->type = $type;
    parent::__construct('fieldset');
    $this->legend = new Legend();
    $this->setName($name)
            ->setLegend($legend);
    foreach ($values as $value => $label) {
      $this->setOption($value, $label);
    }
  }

  public function __destruct() {
    unset($this->legend, $this->options);
    parent::__destruct();
  }

  /**
   * Sets the legend for the fieldset component
   *
   * @param  string|Legend $legend the legend of the fieldset component
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_legend.asp legend tag
   */
  public function setLegend($legend) {
    if (!($legend instanceof Legend)) {
      $legend = new Legend($legend);
    }
    $this->legend = $legend;
    return $this;
  }

  /**
   * Returns the legend for the fieldset component
   *
   * @return Legend the legend component
   * @link   http://www.w3schools.com/tags/tag_legend.asp legend tag
   */
  public function getLegend(): Legend {
    return $this->legend;
  }

  /**
   * Returns the option fields
   *
   * @return Choicebox[] the option fields
   */
  protected function getOptionFields(): array {
    return $this->options;
  }

  /**
   * Sets an option to the input
   * 
   * @param string $value
   * @param string $label
   * @param bool $checked
   * @return $this for a fluent interface
   */
  public function setOption(string $value, string $label, bool $checked = false) {
    $input = FormControls::{$this->type}($this->name, $value, $checked);
    $this->options[$value] = $input;
    $this->labels[$value] = new Label($label, $input);
    return $this;
  }

  public function getName(): ?string {
    return $this->name;
  }

  public function setName(string $name = null) {
    $this->name = $name;
    foreach ($this->options as $box) {
      $box->setName($name);
    }
    return $this;
  }

  public function isNamed(): bool {
    return $this->name !== null;
  }

  public function disable(bool $disabled = true) {
    return $this->setAttribute("disabled", $disabled);
  }

  public function isEnabled(): bool {
    return !$this->attributeExists("disabled");
  }

  public function setInitialValue($value) {
    if (!is_array($value)) {
      $value = [$value];
    }
    foreach ($this->options as $opt) {
      if (in_array($opt->getSubmitValue(), $value)) {
        $opt->setChecked(true);
      } else {
        $opt->setChecked(false);
      }
    }
    return $this;
  }

  /**
   * Returns the current submission set of the input component
   *
   * @return string[] the current submission set of the input component
   */
  public function getSubmitValue() {
    $submission = [];
    foreach ($this->getOptionFields() as $box) {
      if ($box->attributeExists("checked")) {
        $submission[] = $box->getValue();
      }
    }
    return $submission;
  }

  public function contentToString(): string {
    $output = $this->legend;
    foreach ($this->options as $v => $opt) {
      $output .= $opt . $this->labels[$v];
    }
    return $output;
  }

}
