<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\ValidableInput;
use Sphp\Html\Forms\Inputs\FormControls;
use Sphp\Html\Forms\Label;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a Validable Foundation based Inline Input
 * 
 * 
 * @method \Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput select(string $name = null, $value = null) creates a new validable select input
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ValidableInlineInput extends AbstractComponent implements ValidableInput {

  use ValidableInputContainerTrait;

  /**
   * @var Label 
   */
  private $label;

  /**
   * @var Label 
   */
  private $inlineLabel;

  /**
   * @var ValidableInput 
   */
  private $input;

  /**
   * @var Label 
   */
  private $errorMessage;

  /**
   * @var ReflectionClass
   */
  private $inputReflector;

  /**
   * Constructor
   * 
   * @param ValidableInput $input
   * @param string $label
   * @param string $errorMessage
   */
  public function __construct(ValidableInput $input, string $label = null, string $errorMessage = null) {
    parent::__construct('div');
    $this->addCssClass('sphp');
    if (!$input instanceof \Sphp\Html\Component) {
      throw new InvalidArgumentException('Invalid input type');
    }
    if ($label === null) {
      $label = $input->getName();
    }
    $this->input = $input;
    $this->input->addCssClass('input-group-field');
    $this->inputReflector = new ReflectionClass($this->input);
    $this->label = new Label($label);
    $this->label->setFor($this->input);
    $this->errorMessage = new Label($errorMessage);
    $this->errorMessage->addCssClass('form-error');
    $this->errorMessage->setFor($this->input);
    $this->inlineLabel = new Label();
    $this->inlineLabel->addCssClass('input-group-label');
    $this->inlineLabel->setFor($this->input);
    $this->errorMessage->setAttribute('data-form-error-for', $this->input->identify());
  }

  public function __destruct() {
    unset($this->label, $this->inlineLabel, $this->errorMessage, $this->input, $this->inputReflector);
    parent::__destruct();
  }

  /**
   * Invokes the given public Input object method
   * 
   * @param  string $name the name of the called method
   * @param  array $arguments
   * @return mixed
   * @throws BadMethodCallException if the public method does not exixt
   */
  public function __call(string $name, array $arguments) {
    if (!$this->inputReflector->hasMethod($name)) {
      $inputType = get_class($this->input);
      throw new BadMethodCallException("Method $name is not defined in '$inputType' input");
    }
    $result = \call_user_func_array(array($this->input, $name), $arguments);
    if ($result === $this->input) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * Sets/unsets the input validation ignored
   * 
   * @param  bool $ignored true for no validation, false for validation
   * @return $this for a fluent interface
   */
  public function ignoreValidation(bool $ignored = true) {
    $this->input->setAttribute('data-abide-ignore', $ignored);
    return $this;
  }

  public function getInput(): ValidableInput {
    return $this->input;
  }

  /**
   * Returns the input label
   * 
   * @return Label the input label
   */
  public function getLabel(): Label {
    return $this->label;
  }

  /**
   * Returns the inline input label
   * 
   * @return Label the inline input label
   */
  public function getInlineLabel(): Label {
    return $this->inlineLabel;
  }

  /**
   * Returns the error message label
   * 
   * @return Label the error message label
   */
  public function getErrorMessage(): Label {
    return $this->errorMessage;
  }

  /**
   * Sets the error message label content
   * 
   * @param  string $label the label content
   * @return $this for a fluent interface
   */
  public function setLabel(string $label) {
    $this->label->resetContent($label);
    return $this;
  }

  /**
   * Sets the inline label content
   * 
   * @param  string|null $inlineLabel the inline label content
   * @return $this for a fluent interface
   */
  public function setInlineLabel(string $inlineLabel = null) {
    $this->inlineLabel->resetContent($inlineLabel);
    return $this;
  }

  /**
   * Sets the error message label content
   * 
   * @param  string $errorMessage the error message label content
   * @return $this for a fluent interface
   */
  public function setErrorMessage(string $errorMessage) {
    $this->errorMessage->resetContent($errorMessage);
    return $this;
  }

  public function contentToString(): string {
    $output = $this->getLabel() . '<div class="input-group">';
    if ($this->getInlineLabel()->contentToString() !== '') {
      $output .= $this->inlineLabel;
    }
    return $output .= $this->input . '</div>' . $this->errorMessage;
  }

  /**
   * Creates a HTML object
   *
   * @param  string $inputType input type
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $inputType, array $arguments): ValidableInlineInput {
    try {
      $input = FormControls::create($inputType, $arguments);
    } catch (\Exception $ex) {
      
    }
    return new static($input);
  }

}
