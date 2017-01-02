<?php

/**
 * InputColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Grids\ColumnTrait as ColumnTrait;
use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Sections\Paragraph;
use ReflectionClass;
use BadMethodCallException;

/**
 * Implements Foundation framework based component to create  multi-device layouts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputColumn extends AbstractComponent implements InputColumnInterface {

  use ColumnTrait;

  /**
   *
   * @var Label
   */
  private $label;

  /**
   * The inner input component
   *
   * @var InputInterface 
   */
  private $input;

  /**
   * The inner input component
   *
   * @var Span 
   */
  private $errorField;

  /**
   *
   * @var Paragraph
   */
  private $helper;

  /**
   *
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * Constructs a new instance
   *
   * @param  InputInterface $input the actual input component
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   */
  public function __construct(InputInterface $input, $s = 12, $m = false, $l = false, $xl = false, $xxl = false) {
    parent::__construct('div');
    $this->cssClasses()->lock('column');
    $widthSetter = function ($width, $sreenSize) {
      if ($width > 0 && $width < 13) {
        $this->cssClasses()->add("$sreenSize-$width");
      }
    };
    $widthSetter($s, 'small');
    $widthSetter($m, 'medium');
    $widthSetter($l, 'large');
    $widthSetter($xl, 'xlarge');
    $widthSetter($xxl, 'xxlarge');
    $this->label = new Label();
    $this->input = $input;
    $this->errorField = new Span();
    $this->errorField->cssClasses()->lock('form-error');
    $this->reflector = new ReflectionClass($this->input);
    $this->label->offsetSet('labelText', '');
    $this->label->offsetSet('input', $this->input);
    $this->label->offsetSet('error', $this->errorField);
  }

  /**
   * 
   * @return self for PHP Method Chaining
   */
  public function setErrorField($errorMessage) {
    $this->errorField->replaceContent($errorMessage);
    return $this;
  }

  public function getErrorField() {
    return $this->errorField;
  }

  /**
   * Invokes the given method of {@link self} with the rest of the passed arguments.
   * 
   * @param  string $name the name of the called method
   * @param  mixed $arguments
   * @return mixed
   * @throws BadMethodCallException
   */
  public function __call($name, $arguments) {
    if (!$this->reflector->hasMethod($name)) {
      throw new BadMethodCallException($name . ' is not a valid method for this type of input');
    }
    $result = \call_user_func_array(array($this->input, $name), $arguments);
    if ($result === $this->input) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * Returns the actual input component
   * 
   * @return InputInterface the actual input component
   */
  public function getInput() {
    return $this->input;
  }

  /**
   * Returns the label of the component
   * 
   * @return mixed the label of the component
   */
  public function getLabel() {
    return $this->label->offsetGet('labelText');
  }

  /**
   * Sets the visible contents of the input label
   * 
   * @param  mixed $label the contents of the label 
   * @return self for PHP Method Chaining
   */
  public function setLabel($label) {
    $this->label->offsetSet('labelText', $label);
    return $this;
  }

  /**
   * Sets the visible contents of the helpaer label
   * 
   * @param  mixed $text the contents of the helpaer
   * @return self for PHP Method Chaining
   */
  public function setHelperText($text) {
    $this->helper = new Paragraph($text);
    $this->helper->cssClasses()->lock('help-text');
    return $this;
  }

  public function disable($disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  public function isEnabled() {
    return $this->input->isEnabled();
  }

  public function getName() {
    return $this->input->getName();
  }

  public function setName($name) {
    $this->input->setName($name);
    return $this;
  }

  public function isNamed() {
    return $this->input->isNamed();
  }

  public function getSubmitValue() {
    return $this->input->getSubmitValue();
  }

  public function setValue($value) {
    $this->input->setValue($value);
    return $this;
  }

  public function contentToString() {
    return $this->label->getHtml() . $this->helper;
  }

}
