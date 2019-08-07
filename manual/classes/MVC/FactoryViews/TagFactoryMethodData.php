<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Stdlib\Datastructures\Arrayable;
use ReflectionClass;
use Sphp\Html\Navigation\A;
use Sphp\Html\Tag;

/**
 * Implements tag factory data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TagFactoryMethodData implements Arrayable {

  private $factory;
  private $method;

  /**
   * @var Tag
   */
  private $component;

  /**
   * @var ReflectionClass
   */
  private $componentReflector;

  /**
   * @var string 
   */
  private $description;

  /**
   * Constructor
   * 
   * @param string $factory
   * @param string $method
   * @param string $description
   */
  public function __construct(string $factory, string $method, $description) {
    $this->factory = $factory;
    $this->method = $method;
    $this->component = $factory::$method();
    $this->componentReflector = new ReflectionClass($this->component);
    $this->tag = $this->component->getTagName();
    if (is_array($description)) {
      $this->description = $description['desc'];
      $this->name = $this->tag;
      if (array_key_exists('attrs', $description)) {
        $this->name .= ' ' . $description['attrs'];
      }
    } else {
      $this->description = $description;
      $this->name = $this->component->getTagName();
    }
  }

  public function getCreatedComponent(): Tag {
    return $this->component;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function getObjectType(): string {
    return $this->componentReflector->getName();
  }

  public function getW3cLink(): A {
    return Factory::w3schools()->tag($this->tag, "&lt;$this->name&gt;", $this->description);
  }

  /**
   * 
   * @return A
   */
  public function getFactoryCallLink(): A {
    return Factory::sami()->classLinker($this->factory)->methodLink($this->method, true);
  }

  /**
   * 
   * @return A
   */
  public function getObjectTypeLink(): A {
    //$componentReflector = new ReflectionClass($this->component);
    //$objectType = $componentReflector->getName();
    $this->getObjectType();
    return Factory::sami()->classLinker($this->getObjectType())->getLink($this->getObjectType());
  }

  public function toArray(): array {
    $arr = [];
    $arr['w3scools'] = $this->getW3cLink();
    $arr['factoryCall'] = $this->getFactoryCallLink();
    $arr['type'] = $this->getObjectTypeLink();
    return $arr;
  }

  private function tagString(): string {
    $attrs = '' . $this->component->attributes();
    if ($attrs != '') {
      $attrs = ' ' . $attrs;
    }
    return '&lt;' . $this->component->getTagName() . $attrs . '&gt;';
  }

}
