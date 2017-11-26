<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Factory;
use Sphp\Html\TagInterface;
use Sphp\Html\Apps\Manual\Apis;

/**
 * Description of TagComponentDataParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractComponentData implements ComponentData {

  /**
   * @var string 
   */
  private $call;

  /**
   * @var TagInterface 
   */
  private $component;

  /**
   * @var string 
   */
  private $tagName;

  /**
   * @var \ReflectionClass
   */
  private $ref;

  /**
   * @var string 
   */
  private $description;

  public function __construct(string $factoryClass, string $par, string $description) {
    $this->call = $par;
    $this->description = $description;
    $this->component = $factoryClass::$par();
    $this->tagName = $this->component->getTagName();
    $this->ref = new \ReflectionClass($this->component);
  }

  public function getCall() {
    return $this->call;
  }

  public function getDocumentCall() {
    return "Factory::" . $this->call . "()";
  }

  public function getComponent(): \Sphp\Html\TagInterface {
    return $this->component;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function getTagName(): string {
    return $this->tagName;
  }

  public function getObjectType(): string {
    return $this->ref->getName();
  }

  public function toArray(): array {
    $arr = [];
    $arr['tag'] = $this->component->getTagName();
    return $arr;
  }

  public function getCallLink(): string {
    return \Sphp\Manual\api()->classLinker($info->getObjectType())->getLink($info->getMethodtCall() . ": " . $info->getObjectType(), "returns " . $info->getObjectType());
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
