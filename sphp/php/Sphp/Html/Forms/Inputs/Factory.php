<?php

/**
 * Factory.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements an HTML form component factory
 * 
 * @method \Sphp\Html\Forms\Inputs\Menus\Select select(string $name = null, $value = null) creates a new hidden input
 * @method \Sphp\Html\Forms\Inputs\HiddenInput hidden(string $name = null, $value = null) creates a new hidden input
 * @method \Sphp\Html\Forms\Inputs\EmailInput email(string $name = null, $value = null) creates a new email input
 * @method \Sphp\Html\Forms\Inputs\NumberInput number(string $name = null, $value = null) creates a new number input
 * @method \Sphp\Html\Forms\Inputs\SearchInput search(string $name = null, $value = null) creates a new search input
 * @method \Sphp\Html\Forms\Inputs\TextInput text(string $name = null, $value = null) creates a new text input
 * @method \Sphp\Html\Forms\Inputs\Radiobox radio(string $name = null, $value = null) creates a new text input
 * @method \Sphp\Html\Forms\Inputs\Checkbox checkbox(string $name = null, $value = null) creates a new text input
 * @method \Sphp\Html\Forms\Inputs\PasswordInput password(string $name = null, $value = null) creates a new text input
 *
 * @method \Sphp\Html\Forms\Inputs\Buttons\Button push($content = null) creates a new push button
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Factory {

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var string[]
   */
  private static $components = array(
      'pushButton' => \Sphp\Html\Forms\Buttons\Button::class,
      'resetButton' => \Sphp\Html\Forms\Buttons\Resetter::class,
      'submitButton' => \Sphp\Html\Forms\Buttons\Submitter::class,
      'push' => \Sphp\Html\Forms\Inputs\Buttons\Button::class,
      'reset' => Buttons\Resetter::class,
      'submit' => Buttons\Submitter::class,
      'input' => InputTag::class,
      'hidden' => HiddenInput::class,
      'text' => TextInput::class,
      'email' => EmailInput::class,
      'password' => PasswordInput::class,
      'radio' => Radiobox::class,
      'checkbox' => Checkbox::class,
      'search' => SearchInput::class,
      'number' => NumberInput::class,
      'optgroup' => Menus\Optgroup::class,
      'option' => Menus\Option::class,
      'textarea' => Textarea::class,
      'keygen' => EmptyTag::class,
      'menu' => ContainerTag::class,
      'meter' => ContainerTag::class,
      'output' => ContainerTag::class,
      'select' => Menus\Select::class,
  );

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Input the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments) {
    if (!isset(static::$components[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    if (is_string(static::$components[$name])) {
      static::$components[$name] = new ReflectionClass(static::$components[$name]);
    }
    $reflectionClass = static::$components[$name];
    $instance = $reflectionClass->newInstanceArgs($arguments);
    return $instance;
  }

}
