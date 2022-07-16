<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Dice\Dice;
use Sphp\Html\Attributes\Exceptions\AttributeException;

/**
 * Class AttributeFactory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AttributeFactory {

  private Dice $di;
  private string $defaultType;

  /**
   * Constructor
   *
   * @param string $defaultType
   */
  public function __construct(string $defaultType = ScalarAttribute::class) {
    $this->defaultType = $defaultType;
    $rules = [
        IdStorage::class => ['shared' => true],
        PropertyParser::class => ['shared' => true],
        $this->defaultType => [
            'shared' => false
        ],
        'id' => [
            'shared' => false,
            'instanceOf' => IdAttribute::class
        ],
        'class' => [
            'shared' => false,
            'instanceOf' => ClassAttribute::class
        ],
        'style' => [
            'shared' => false,
            'instanceOf' => StyleAttribute::class
        ],
    ];
    $this->di = new Dice;
    $this->di = $this->di->addRules($rules);
  }

  public function __destruct() {
    unset($this->di);
  }

  /**
   * 
   * @param  string $name the attribute name
   * @return string the valid Attribute object type for the attribute name
   */
  public function getValidType(string $name): string {
    if (!$this->hasMapping($name)) {
      return Attribute::class;
    }
    return $this->di->getRule($name)['instanceOf'];
  }

  /**
   * 
   * @param  string $name the attribute name
   * @param  string|object $new
   * @return bool
   */
  public function isValidType(string $name, $new): bool {
    return is_a($new, $this->getValidType($name), true);
  }

  /**
   * 
   * 
   * @param  string $name
   * @param  string $pattern
   * @param  mixed $value
   * @return PatternAttribute
   * @throws AttributeException
   */
  public function createPatternAttribute(string $name, string $pattern, $value = null): PatternAttribute {
    if (!$this->isValidType($name, PatternAttribute::class)) {
      throw new AttributeException("Cannot use pattern attribute for '$name' attribute");
    }
    return new PatternAttribute($name, $pattern, $value);
  }

  public function hasMapping(string $name): bool {
    return !empty($this->di->getRule($name));
  }

  /**
   * 
   * @param  string $name
   * @param  mixed $value
   * @return Attribute
   */
  public function createObject(string $name, $value = null): Attribute {
    //  var_dump($name,$this->hasMapping($name));
    if ($this->hasMapping($name)) {
      $instance = $this->di->create($name, [$name, $value]);
    } else {
      $instance = $this->di->create($this->defaultType, [$name, $value]);
    }
    if ($value !== null) {
      $instance->setValue($value);
    }
    return $instance;
  }

  public function createImmutableAttribute(string $name, $value): ImmutableAttribute {
    if (!$this->isValidType($name, ImmutableAttribute::class)) {
      throw new AttributeException("Cannot use pattern attribute for '$name' attribute");
    }
    $obj = $this->di->create(ImmutableAttribute::class, [$name, $value]);
    return $obj;
  }

  public function createIdAttribute(string $name, $value): IdAttribute {
    return $this->di->create(IdAttribute::class, [$name, $value]);
  }

  private static ?AttributeFactory $instance = null;

  public static function singelton(): AttributeFactory {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
