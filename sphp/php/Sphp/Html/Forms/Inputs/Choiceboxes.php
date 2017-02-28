<?php

/**
 * Choiceboxes.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Forms\Inputs\InputTag as InputTag;
use Sphp\Stdlib\Strings;
use Sphp\Html\Forms\LabelableInterface as LabelableInterface;
use Sphp\Html\Forms\Label;

/**
 * A component containing multiple radio or checkbox inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-10-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Choiceboxes extends AbstractContainerComponent implements InputInterface, LabelableInterface {

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
   * @var InputTag[]
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
    $this->boxCont = new Ul();
    $this->boxCont->addCssClass("inline-list");
    //$this->mainLabel = new Legend($mainLabel)
    $this->setName($name)
            ->setOptions($values)
            ->setLabel($label);
    $this->cssClasses()->lock("sphp-choiceboxes $this->type");
    $this->getInnerContainer()
            ->append($this->boxCont);
  }

  /**
   * Adds a new input option to the component
   *
   * @param  Choicebox $label the label information of the new input option
   * @param  Choicebox $value the value of the new input option
   * @return self for a fluent interface
   */
  protected function addInput($label, $value) {
    $input = \Sphp\Html\Document::get($this->type);
    $input->setName($this->name);
    $input->setValue($value);
    //$input = new InputTag($this->type, $this->name, $value);
    $this->options[] = $input;
    $this->boxCont[] = (new Label())
            ->offsetSet("input", $input)
            ->offsetSet("label", "<span>$label</span>");
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
   * Checks whether the fslider has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   *  passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed() {
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
   * @return self for a fluent interface
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
  public function getSubmitValue() {
    $submission = [];
    foreach ($this->getOptionFields() as $box) {
      if ($box->attrExists("checked")) {
        $submission[] = $box->getSubmitValue();
      }
    }
    return $submission;
  }

  /**
   * Sets the content of the input label ({@link Label})
   *
   * @param  mixed $label the content of the input label ({@link Label})
   * @return self for a fluent interface
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
  public function createLabel() {
    return $this->label;
  }

}
