<?php

/**
 * BoxContainer.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Fieldset as Fieldset;
use Sphp\Html\Forms\Legend as Legend;
use Sphp\Html\AbstractContainerComponent as AbstractComponent;
use Sphp\Html\Lists\Ul as Ul;
use Sphp\Html\Forms\Input\Input as InputTag;
use Sphp\Core\Types\Strings as Strings;

/**
 * A component containing multiple radio or checkbox inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Choiceboxes extends AbstractComponent implements InputInterface, LabelableInterface {

  /**
   * the type of the individual input component
   *
   * @var string
   */
  private $type;

  /**
   * the name of the component
   *
   * @var string
   */
  private $name;

  /**
   * the main label component
   *
   * @var Label
   */
  private $label;

  /**
   * the options
   *
   * @var Input[]
   */
  private $options = array();

  /**
   * the box container
   *
   * @var Ul
   */
  private $boxCont;

  /**
   * Constructs a new instance
   *
   * @param string $type the type of the individual input component
   * @param string $name the value of the name attribute
   * @param scalar[] $values
   * @param mixed $label
   */
  public function __construct($type, $name = null, array $values = [], $label = null) {
    $this->type = $type;
    parent::__construct("fieldset");
    $this->content()->set("legend", new Legend());
    $this->boxCont = new Ul();
    $this->boxCont->addCssClass("inline-list");
    //$this->mainLabel = new Legend($mainLabel)
    $this->setName($name)
            ->setOptions($values)
            ->setLabel($label);
    $this->cssClasses()->lock("sphp-choiceboxes $this->type");
    $this->content()
            ->append($this->boxCont);
  }

  /**
   * Sets the {@link Legend} of the fieldset component
   *
   * @param  string|Legend $legend the legend of the fielset component
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/tag_legend.asp legend tag
   */
  public function setLegend($legend) {
    if (!($legend instanceof Legend)) {
      $legend = new Legend($legend);
    }
    $this->content()->set("legend", $legend);
    return $this;
  }

  /**
   * Returns the {@link Legend} of the fieldset component
   *
   * @return Legend the legend of the fieldset component or null
   * @link   http://www.w3schools.com/tags/tag_legend.asp legend tag
   */
  public function getLegend() {
    return $this->content("legend");
  }

  /**
   * Adds a new input option to the component
   *
   * @param  Choicebox $label the label information of the new input option
   * @param  Choicebox $value the value of the new input option
   * @return self for PHP Method Chaining
   */
  protected function addInput($label, $value) {
    $input = new InputTag($this->type, $this->name, $value);
    $this->options[] = $input;
    $this->boxCont[] = (new Label())->set("input", $input)->set("label", "<span>$label</span>");
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
   * @return self for PHP Method Chaining
   */
  public function setOptions(array $values) {
    foreach ($values as $value => $label) {
      $this->addInput($label, $value);
    }
    return $this;
  }

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
   * @return self for PHP Method Chaining
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
   * Checks whether the fslider has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   *  passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed() {
    return Strings::notEmpty($this->name);
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disable($disabled = true) {
    return $this->setAttr("disabled", $disabled);
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled() {
    return !$this->attrExists("disabled");
  }

  /**
   * Sets the current submission set of the input component
   *
   * @param  string|string[] $value the current submission set of the input component
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    if (!is_array($value)) {
      $value = [$value];
    }
    foreach ($this->options as $opt) {
      if (in_array($opt->getValue(), $value)) {
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
  public function getValue() {
    $submission = [];
    foreach ($this->getOptionFields() as $box) {
      if ($box->attrExists("checked")) {
        $submission[] = $box->getValue();
      }
    }
    return $submission;
  }

  /**
   * Sets the content of the input label ({@link Label})
   *
   * @param  mixed $label the content of the input label ({@link Label})
   * @return self for PHP Method Chaining
   */
  public function setLabel($label) {
    if (!($label instanceof Label)) {
      $this->label = new Label($label);
    } else {
      $this->label = $label;
    }
    return $this;
  }

  /**
   * Checks whether the {@link Label} is defined for the input component or 
   *  not
   *
   * @return boolean true if the label is defined, otherwise false
   * @link   Label
   */
  public function hasLabel() {
    return $this->label instanceof Label;
  }

  /**
   * Creates a {@link Label} component for the input component
   *
   * @return Label|null created label component
   */
  public function getLabel() {
    return $this->label;
  }

}
