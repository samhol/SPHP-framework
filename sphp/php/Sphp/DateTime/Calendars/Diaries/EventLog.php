<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Diaries;

/**
 * Description of EventLog
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EventLog extends AbstractLog {
  
  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $description;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructor
   * 
   * @param DateConstraint $constraint date constraints
   * @param string $name
   * @param string $description
   */
  public function __construct(DateConstraint $constraint, string $name, string $description = null) {
    parent::__construct($constraint);
    $this->setName($name)->setDescription("$description");
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->description, $this->data);
    parent::__destruct();
  }

  public function __toString(): string {
    $output = "$this->name";
    $output .= $this->description;
    return $output;
  }

  public function toString(): string {
    $output = "$this->name : $this->description";

    return $output;
  }

  /**
   * 
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Sets the name of the log
   * 
   * @param  string $name the name of the log
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Returns the description text
   * 
   * @return string the description text
   */
  public function getDescription(): string {
    return "$this->description";
  }

  /**
   * Sets the description text
   * 
   * @param  string|null $description the description text
   * @return $this for a fluent interface
   */
  public function setDescription(string $description = null) {
    $this->description = $description;
    return $this;
  }

  /**
   * 
   * @return mixed
   */
  public function getData() {
    return $this->data;
  }

  /**
   * 
   * @param  mixed $data
   * @return $this
   */
  public function setData($data) {
    $this->data = $data;
    return $this;
  }
}
