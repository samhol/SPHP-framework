<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\Content;
use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Stdlib\Datastructures\Arrayable;
use ReflectionClass;

/**
 * Implements tag factory data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TagFactoryMethodData implements Arrayable {

  /**
   * @var string 
   */
  private $method;

  /**
   * @var Content 
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

  public function __construct(string $factory, string $method, string $description) {
    $this->factoryCall = (new ReflectionClass($factory))->getShortName() . "::$method()";
    $this->description = $description;
    $this->component = $factory::$method();
    $this->componentReflector = new ReflectionClass($this->component);
  }

  public function getFactoryCall(): string {
    return $this->factoryCall;
  }

  public function getCreatedComponent(): Content {
    return $this->component;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function getCreatedObjectReflector(): string {
    return $this->componentReflector->getName();
  }

  public function getObjectType(): string {
    return $this->componentReflector->getName();
  }

  public function toArray(): array {
    $arr = [];
    $arr[] = Factory::w3schools()->tag($this->component->getTagName(), $this->tagString(), $this->description);
    $arr[] = Factory::sami()->classLinker($this->getObjectType())->getLink("$this->factoryCall: ");
    $arr[] = Factory::sami()->classLinker($this->getObjectType())->getLink($this->getObjectType());
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
