<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;
use Sphp\Html\Span;
use Sphp\Html\Flow\Paragraph;
use ReflectionClass;
use BadMethodCallException;
use Sphp\Html\Foundation\Sites\Grids\ColumnLayoutManager;
use Sphp\Html\Foundation\Sites\Grids\ColumnLayoutManagerInterface;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Inputs\Textarea;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\EmailInput;

/**
 * Implements framework based component to create  multi-device layouts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InputColumn extends AbstractComponent implements InputColumnInterface {

  /**
   * @var Label
   */
  private $label;

  /**
   * The inner input component
   *
   * @var Input 
   */
  private $input;

  /**
   * The inner input component
   *
   * @var Span 
   */
  private $errorField;

  /**
   * @var Paragraph
   */
  private $helper;

  /**
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * @var ColumnLayoutManager 
   */
  private $layoutManager;

  /**
   * Constructor
   *
   * @param  Input $input the actual input component
   * @param  string[] $layout the layout parameters
   */
  public function __construct(Input $input, array $layout = ['auto']) {
    parent::__construct('div');
    $this->layoutManager = new ColumnLayoutManager($this);
    $this->layout()->setLayouts($layout);
    $this->label = new Label();
    $this->input = $input;
    $this->errorField = new Span();
    $this->errorField->cssClasses()->protect('form-error');
    $this->reflector = new ReflectionClass($this->input);
    $this->label->offsetSet('labelText', '');
    $this->label->offsetSet('input', $this->input);
    $this->label->offsetSet('error', $this->errorField);
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function setErrorField($errorMessage) {
    $this->errorField->resetContent($errorMessage);
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
   * @return Input the actual input component
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
   * @return $this for a fluent interface
   */
  public function setLabel($label) {
    $this->label->offsetSet('labelText', $label);
    return $this;
  }

  /**
   * Sets the visible contents of the helper label
   * 
   * @param  mixed $text the contents of the helper
   * @return $this for a fluent interface
   */
  public function setHelperText($text) {
    $this->helper = new Paragraph($text);
    $this->helper->cssClasses()->protect('help-text');
    return $this;
  }

  public function disable(bool $disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return $this->input->isEnabled();
  }

  public function getName() {
    return $this->input->getName();
  }

  public function setName(string $name = null) {
    $this->input->setName($name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->input->isNamed();
  }

  public function getSubmitValue() {
    return $this->input->getSubmitValue();
  }

  public function setSubmitValue($value) {
    $this->input->setSubmitValue($value);
    return $this;
  }

  public function contentToString(): string {
    return $this->label->getHtml() . $this->helper;
  }

  public function layout(string ...$layout): ColumnLayoutManagerInterface {
    if (!empty($layout)) {
      $this->layoutManager->setLayouts($layout);
    }
    return $this->layoutManager;
  }

  /**
   * 
   * @param type $name
   * @param type $value
   * @param array $layout
   * @return \self
   */
  public static function email($name, $value = null, array $layout = ['small-12']) {
    $input = new EmailInput($name, $value);
    return new self($input, $layout);
  }

  /**
   * 
   * @param type $name
   * @param type $value
   * @param array $layout
   * @return \self
   */
  public static function text($name, $value = null, array $layout = ['small-12']) {
    $input = new TextInput($name, $value);
    return new self($input, $layout);
  }

  /**
   * 
   * @param type $name
   * @param type $opt
   * @param type $selectedValues
   * @param array $layout
   * @return \self
   */
  public static function select($name, $opt, $selectedValues = null, array $layout = ['small-12']) {
    $input = new Select($name, $opt, $selectedValues);
    return new self($input, $layout);
  }

  /**
   * Creates a new instance containing a textarea component
   * 
   * @precondition  `$rows > 0 & $cols > 0`
   * @param  string $name name attribute value
   * @param  string $content the content of the component
   * @param  string $rows the value of the rows attribute (visible height of a text area)
   * @param  array $layout
   * @link   http://www.w3schools.com/tags/att_textarea_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   * @return self new instance containing a textarea component
   * @link   Sphp\Html\Forms\Inputs\Textarea Textarea
   */
  public static function textarea($name, $content = null, $rows = 4, array $layout = ['small-12']) {
    $input = new Textarea($name, $content, $rows);
    return new self($input, $layout);
  }

  /**
   * Creates a HTML object
   *
   * @param  string $inputType input type
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $inputType, array $arguments): Tag {
    try {
      $input = \Sphp\Html\Forms\Inputs\Factory::__callStatic($arguments);
    } catch (\Exception $ex) {
      
    }
    if (!isset(static::$tags[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    if (is_string(static::$tags[$name])) {
      static::$tags[$name] = new ReflectionClass(static::$tags[$name]);
    }
    $reflectionClass = static::$tags[$name];
    if ($reflectionClass->getName() == EmptyTag::class || $reflectionClass->getName() == ContainerTag::class) {
      array_unshift($arguments, $name);
    }
    $instance = static::$tags[$name]->newInstanceArgs($arguments);
    return $instance;
  }

}
