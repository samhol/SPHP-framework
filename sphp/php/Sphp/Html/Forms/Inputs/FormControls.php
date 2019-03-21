<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Buttons as ButtonTags;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\BadMethodCallException;
use ReflectionClass;
use Sphp\Html\Forms\FormController;

/**
 * Implements an HTML form component factory
 * 
 * @method \Sphp\Html\Forms\Inputs\Menus\Select select(string $name = null, $value = null) creates a new hidden input
 * @method \Sphp\Html\Forms\Inputs\HiddenInput hidden(string $name = null, $value = null) creates a new hidden input
 * @method \Sphp\Html\Forms\Inputs\EmailInput email(string $name = null, $value = null) creates a new email input
 * @method \Sphp\Html\Forms\Inputs\NumberInput number(string $name = null, $value = null) creates a new number input
 * @method \Sphp\Html\Forms\Inputs\SearchInput search(string $name = null, $value = null) creates a new search input
 * @method \Sphp\Html\Forms\Inputs\TextInput text(string $name = null, $value = null) creates a new text input
 * @method \Sphp\Html\Forms\Inputs\Radiobox radio(string $name = null, $value = null) creates a new radio input
 * @method \Sphp\Html\Forms\Inputs\Checkbox checkbox(string $name = null, $value = null) creates a new checkbox input
 * @method \Sphp\Html\Forms\Inputs\PasswordInput password(string $name = null, $value = null) creates a new password input
 * @method \Sphp\Html\Forms\Inputs\Menus\Select select(string $name = null, $value = null) creates a new password input
 * 
 * 
 * @method \Sphp\Html\Forms\Buttons\Button pushButton(string $name = null, $value = null) creates a new password input
 * @method \Sphp\Html\Forms\Buttons\Resetter reset(string $name = null, $value = null) creates a new password input
 * @method \Sphp\Html\Forms\Buttons\Submitter submit(string $name = null, $value = null) creates a new password input
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class FormControls {

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var string[]
   */
  private static $components = [
      'inputButton' => Buttons\InputButton::class,
      'resetInput' => Buttons\ResetInput::class,
      'submitInput' => Buttons\SubmitInput::class,
      'reset' => ButtonTags\Resetter::class,
      'submit' => ButtonTags\Submitter::class,
      'button' => ButtonTags\Button::class,
      'input' => InputTag::class,
      'hidden' => HiddenInput::class,
      'text' => TextInput::class,
      'email' => EmailInput::class,
      'password' => PasswordInput::class,
      'radio' => Radiobox::class,
      'checkbox' => Checkbox::class,
      'search' => SearchInput::class,
      'number' => NumberInput::class,
      'file' => FileInput::class,
      'optgroup' => Menus\Optgroup::class,
      'option' => Menus\Option::class,
      'textarea' => Textarea::class,
      'color' => InputTag::class,
      'date' => InputTag::class,
      'datetime-local' => InputTag::class,
      'range' => InputTag::class,
      'tel' => InputTag::class,
      'time' => InputTag::class,
      'url' => InputTag::class,
      'week' => InputTag::class,
      'select' => Menus\Select::class,
  ];

  /**
   * Return the object map used
   * 
   * @return string[]
   */
  public static function getObjectMap(): array {
    return static::$components;
  }

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return FormController the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): FormController {
    if (!isset(static::$components[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    return static::create($name, $arguments);
  }

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return FormController the corresponding component
   * @throws InvalidArgumentException if the tag object does not exist
   */
  public static function create(string $name, array $arguments = []): FormController {
    if (!isset(static::$components[$name])) {
      throw new InvalidArgumentException("Method $name does not exist");
    }
    if (static::$components[$name] === InputTag::class) {
      array_unshift($arguments, $name);
    }
    $reflectionClass = new ReflectionClass(static::$components[$name]);
    if ($reflectionClass->getName() == InputTag::class) {
      array_unshift($arguments, $name);
    }
    $instance = $reflectionClass->newInstanceArgs($arguments);
    return $instance;
  }

}
