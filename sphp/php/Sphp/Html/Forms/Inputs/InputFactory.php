<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Forms\{
  Label,
  Fieldset,
  Legend
};

/**
 * Class InputFactory
 *
 * @method static \Sphp\Html\Forms\ContainerForm form(string $action = null, string $method = null, $content = null) creates a &lt;form&gt; object
 * @method static \Sphp\Html\Forms\Fieldset fieldset(mixed $content = null, $for = null) creates a &lt;fieldset&gt; object
 * @method static \Sphp\Html\Forms\Label label(mixed $content = null, $for = null) creates a &lt;label&gt; object
 * @method static \Sphp\Html\Forms\Inputs\HiddenInput hidden(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method static \Sphp\Html\Forms\Inputs\TextInput text(mixed $content = null, $for = null) creates a &lt;input type=text&gt; object
 * @method static \Sphp\Html\Forms\Inputs\Radiobox radio(mixed $content = null, $for = null) creates a &lt;input type=radio&gt; object
 * @method static \Sphp\Html\Forms\Inputs\SearchInput search(?string $name = null, $for = null) creates an instance of Search Input
 * @method static \Sphp\Html\Forms\Inputs\Menus\Select select(?string $name = null, ?iterable $options = null) creates an instance of Search Input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class InputFactory {

  /**
   * list of form component types and their corresponding PHP classes
   *
   * @var array<string, string>
   */
  private static array $inputs = [
      'label' => Label::class,
      'legend' => Legend::class,
      'fieldset' => Fieldset::class,
      
      'hidden' => HiddenInput::class,
      'text' => TextInput::class,
      'search' => SearchInput::Class,
      'email' => EmailInput::class,
      'password' => PasswordInput::class,
      'radio' => Radiobox::class,
      'checkbox' => Forms\Inputs\Checkbox::class,
      'number' => NumberInput::class,
      'reset' => Buttons\ResetInput::class,
      'submit' => Buttons\SubmitInput::class,
      'textarea' => Textarea::class,
      'select' => Menus\Select::class,
      'optgroup' => Menus\Optgroup::class,
      'option' => Menus\Option::class,
  ];

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws BadMethodCallException if the tag object does not exist
   */
  public static function __callStatic(string $name, array $arguments): Input {
    try {
      return static::input($name, ...$arguments);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("Method '$name' Does not exist", 0, $ex);
    }
  }

  /**
   * Creates an HTML input object
   *  
   * @param  string $type
   * @param  string|null $name 
   * @param  scalar|null $value
   * @return Input the corresponding input component
   * @throws InvalidArgumentException if the input component type does not exist
   */
  public static function input(string $type, ?string $name = null, $value = null): Input {
    if (!isset(static::$inputs[$type])) {
      throw new InvalidArgumentException("input type '$type' does not exist");
    }
    $instance = new static::$inputs[$type];
    $instance->setName($name);
    $instance->setInitialValue($value);
    return $instance;
  }

}
