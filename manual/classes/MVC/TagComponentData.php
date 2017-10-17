<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC;

/**
 * Description of TagComponentDataParser
 *
 * @author samih
 */
class TagComponentData {

  /**
   *
   * @var TagInterface 
   */
  private $component;
  /**
   *
   * @var string 
   */
  private $tagName;
  /**
   *
   * @var \ReflectionClass
   */
  private $ref;
  /**
   *
   * @var string 
   */
  private $objectType;

  public function __construct(string $par) {
    $this->component = Document::get($par);
    $this->tagName = $this->component->getTagName();
    $this->ref = new \ReflectionClass($this->component);
  }
  public function getComponent(): TagInterface {
    return $this->component;
  }

  public function getTagName(): string {
    return $this->tagName;
  }

  public function getObjectType(): string {
    return $this->ref->getName();
  }

    public function toArray():array {
    $arr = [];
    $arr['tag'] = $this->component->getTagName();
    return $arr;
  }

}
