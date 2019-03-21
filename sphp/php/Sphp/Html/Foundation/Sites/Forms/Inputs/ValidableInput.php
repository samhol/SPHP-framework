<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;
use Sphp\Html\IdentifiableContent;
use Sphp\Html\Forms\Inputs\Factory;
/**
 * Description of ValidableInput
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ValidableInput extends \Sphp\Html\AbstractComponent {

  /**
   * @var Label 
   */
  private $label;

  /**
   * @var Label 
   */
  private $inlineLabel;

  /**
   * @var Input 
   */
  private $input;

  /**
   * @var Label 
   */
  private $errorMessage;

  /**
   * Constructor
   * 
   * @param Input $input
   * @param string $label
   * @param string $errorMessage
   */
  public function __construct(Input $input, string $label, string $errorMessage) {
    parent::__construct('div');
    $this->addCssClass('sphp');
    if (!$input instanceof \Sphp\Html\Component) {
      throw new InvalidArgumentException('Invalid input type');
    }
    $this->input = $input;
    $this->buildComponents($label, $errorMessage);
  }

  public function __destruct() {
    unset($this->label, $this->inlineLabel, $this->errorMessage, $this->input);
    parent::__destruct();
  }

  private function buildComponents(string $label) {
    $this->input->addCssClass('input-group-field');
    $this->label = new Label($label);
    $this->errorMessage = new Label($label);
    $this->errorMessage->addCssClass('form-error');
    $this->inlineLabel = new Label();
    $this->inlineLabel->addCssClass('input-group-label');
    $this->label->setFor($this->input);
    $this->label->setFor($this->inlineLabel);
    $this->errorMessage->setAttribute('data-form-error-for', $this->input->identify());
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
   * @param  Label $label the label content
   * @return $this for a fluent interface
   */
  public function setLabel(Label $label) {
    $this->label = $label;
    return $this;
  }

  /**
   * Sets the inline label content
   * 
   * @param  string $inlineLabel the inline label content
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
    return $output .= $this->input . '</div>';
  }

  
  public static function __callStatic(string $name, $arguments) {
    ;
  }
}
