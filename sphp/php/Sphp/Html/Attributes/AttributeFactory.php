<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Dice\Dice;

/**
 * Class AttributeFactory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AttributeFactory {

  /**
   * @var Dice 
   */
  private $di;

  /**
   * @var string 
   */
  private $defaultType;

  /**
   * Constructor
   *
   * @param string $defaultType
   */
  public function __construct(string $defaultType = ScalarAttribute::class) {
    $this->defaultType = $defaultType;
    $this->rules = [
        IdStorage::class => ['shared' => true],
        CssClassParser::class => ['shared' => true],
        PropertyParser::class => ['shared' => true],
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
            'instanceOf' => PropertyCollectionAttribute::class
        ],
    ];
    $this->di = new Dice;
    $this->di = $this->di->addRules($this->rules);
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  public function getValidType(string $name): string {
    $type = Attribute::class;
    if (array_key_exists($name, $this->rules)) {
      $type = $this->rules[$name]['instanceOf'];
    }
    return $type;
  }

  /**
   * 
   * @param  string $name
   * @param  string|object $new
   * @return boolean
   */
  public function isValidType(string $name, $new): bool {
    return is_a($new, $this->getValidType($name), true);
  }

  public function createObject(string $name, $value = null): Attribute {
    if (array_key_exists($name, $this->rules)) {
      $instance = $this->di->create($name, [$name, $value]);
    } else {
      $instance = $this->di->create($this->defaultType, [$name, $value]);
    }
    if ($value !== null) {
      $instance->setValue($value);
    }
    return $instance;
  }

  public function createImmutableAttribute(string $name, $value): Attribute {
    if (!$this->isValidType($name, ImmutableAttribute::class)) {
      $obj = $this->createObject($name, $value);
      $obj->protectValue($value);
    } else {
      $obj = $this->di->create(ImmutableAttribute::class, [$name, $value]);
    }
    return $obj;
  }

  public function createIdAttribute(string $name, $value): IdAttribute {
    return $this->di->create(IdAttribute::class, [$name, $value]);
  }

  private static $instance;

  public static function instance(): AttributeFactory {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
