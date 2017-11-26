<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Forms\Inputs;

use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Description of Factory
 * @method \Sphp\Html\Forms\Inputs\EmailInput email(mixed $content = null) creates a new email inpue component
 * @method \Sphp\Html\Span span(mixed $content = null) creates a new span tag component
 *
 * @author samih
 */
class Input {

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var string[]
   */
  private static $components = array(
      'pushButton' => \Sphp\Html\Forms\Buttons\Button::class,
      'resetButton' => \Sphp\Html\Forms\Buttons\Resetter::class,
      'submitButton' => \Sphp\Html\Forms\Buttons\Submitter::class,
      'input' => InputTag::class,
      'hidden' => HiddenInput::class,
      'text' => TextInput::class,
      'email' => EmailInput::class,
      'password' => PasswordInput::class,
      'radio' => Radiobox::class,
      'checkbox' => Checkbox::class,
      'number' => NumberInput::class,
      'reset' => Buttons\Resetter::class,
      'submit' => Buttons\Submitter::class,
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
   * @return InputInterface the corresponding component
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
