<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\ContentInterface;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Stdlib\Datastructures\Arrayable;
use ReflectionClass;

/**
 * Description of TagComponentDataParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FactoryMethodData implements Arrayable {

  /**
   * @var string 
   */
  private $call;

  /**
   * @var ContentInterface 
   */
  private $component;

  /**
   * @var string 
   */
  private $tagName;

  /**
   * @var ReflectionClass
   */
  private $componentReflector;

  /**
   * @var string 
   */
  private $description;

  public function __construct(string $className, string $par, string $description) {
    $this->factory = $className;
    $this->call = $par;
    $this->description = $description;
    $this->component = $this->factory::$par();
    $this->tagName = $this->component->getTagName();
    $this->componentReflector = new ReflectionClass($this->component);
  }

  public function getMethodCall(): string {
    $name = (new ReflectionClass($this->factory))->getShortName();
    //echo '<pre>';
    //var_dump((new \ReflectionClass($this->factory))->getDocComment());
    return "$name::$this->call()";
  }

  public function getComponent(): ContentInterface {
    return $this->component;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function getTagName(): string {
    return $this->tagName;
  }

  public function getObjectType(): string {
    return $this->componentReflector->getName();
  }

  public function toArray(): array {
    $arr = [];
    $arr['tag'] = $this->component->getTagName();
    return $arr;
  }

  private function tagString(): string {
    $attrs = '' . $this->component->attrs();
    if ($attrs != '') {
      $attrs = ' ' . $attrs;
    }
    return '&lt;' . $this->component->getTagName() . $attrs . '&gt;';
  }

  public function getW3schoolsLink(): string {
    return Apis::w3schools()->tag($this->component->getTagName(), $this->tagString(), $this->description);
  }

}
