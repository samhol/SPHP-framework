<?php

/**
 * BoxContainer.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Legend;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Foundation\Sites\Grids\ColumnInterface;
use Sphp\Html\Container;
use Sphp\Html\Forms\Inputs\Choicebox;
use Sphp\Html\Forms\Label;
use Sphp\Stdlib\Strings;
use Sphp\Html\Foundation\Sites\Grids\ColumnLayoutManager;
use Sphp\Html\Foundation\Sites\Grids\ColumnLayoutManagerInterface;

/**
 * A component containing multiple radio or checkbox inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-18
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/forms.html#checkboxes-and-radio-buttons Foundation 6 Checkboxes and Radio Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Choiceboxes extends AbstractComponent implements InputInterface, ColumnInterface {

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
  private $options = array();

  /**
   * the box container
   *
   * @var Container
   */
  private $boxes;

  /**
   *
   * @var ColumnLayoutManager
   */
  private $layout;

  /**
   * Constructs a new instance
   *
   * @param string $name the value of the name attribute
   * @param scalar[] $values
   * @param mixed $legend
   */
  public function __construct($name = null, array $values = [], $legend = null) {
    parent::__construct("fieldset");
    $this->legend = new Legend();
    $this->boxes = new Container();
    $this->setName($name)
            ->setLegend($legend);
    foreach ($values as $value => $label) {
      $this->setOption($value, $label);
    }
    $this->layout = new ColumnLayoutManager($this);
  }

  /**
   * 
   * @return ColumnLayoutManagerInterface
   */
  public function layout(): ColumnLayoutManagerInterface {
    return $this->layout;
  }

  /**
   * Sets the {@link Legend} of the fieldset component
   *
   * @param  string|Legend $legend the legend of the fieldset component
   * @return self for a fluent interface
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
   * Returns the {@link Legend} of the fieldset component
   *
   * @return Legend the legend of the fieldset component or null
   * @link   http://www.w3schools.com/tags/tag_legend.asp legend tag
   */
  public function getLegend() {
    return $this->legend;
  }

  /**
   * Adds a new input option to the component
   * 
   * @param  Choicebox $input
   * @param  mixed $label
   * @return self for a fluent interface
   */
  protected function setInput(Choicebox $input, $label) {
    $index = $input->getSubmitValue();
    $label = new Label($label, $input);
    $this->options[$index] = $input;
    $this->boxes[$index] = $input;
    $this->boxes[$index . "_label"] = $label;
    return $this;
  }

  /**
   * Returns the option fields
   *
   * @return Choicebox the option fields
   */
  protected function getOptionFields() {
    return $this->options;
  }

  /**
   * Sets new options to the form component
   *
   * @param  string[] $values
   * @return self for a fluent interface
   */
  abstract public function setOption($value, $label, bool $checked = false);

  /**
   * Returns the value of name attribute
   *
   * @return string the value of the name attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets the value of name attribute
   *
   * @param  string $name the value of the name attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function setName($name) {
    $this->name = $name;
    foreach ($this->options as $box) {
      $box->setName($name);
    }
    return $this;
  }

  /**
   * Checks whether the slider has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   *  passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed(): bool {
    return !Strings::isEmpty($this->name);
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for a fluent interface
   */
  public function disable(bool $disabled = true) {
    return $this->setAttr("disabled", $disabled);
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attrExists("disabled");
  }

  /**
   * Sets the current submission set of the input component
   *
   * @param  string|string[] $value the current submission set of the input component
   * @return self for a fluent interface
   */
  public function setValue($value) {
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
      if ($box->attrExists("checked")) {
        $submission[] = $box->getValue();
      }
    }
    return $submission;
  }

  public function count(): int {
    return $this->boxes->count();
  }

  public function contentToString(): string {
    return $this->legend . $this->boxes;
  }

}
