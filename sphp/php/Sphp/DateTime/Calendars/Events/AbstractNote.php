<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

/**
 * Description of Note
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractNote implements Event {

  /**
   * @var bool 
   */
  private $flags = [];

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $description;

  /**
   * Constructor
   * 
   * @param string $name
   * @param string $description
   */
  public function __construct(string $name, string $description = null) {
    $this->setName($name)->setDescription("$description");
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->description);
  }

  public function __toString(): string {
    $output = "$this->name";
    $output .= $this->description;
    return $output;
  }

  public function eventAsString(): string {
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
   * 
   * @param type $name
   * @return $this for a fluent interface
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * 
   * @return bool
   */
  public function hasFlag($flag): bool {
    return in_array($flag, $this->flags, true);
  }

  /**
   * 
   * @param  mixed $flag
   * @return $this for a fluent interface
   */
  public function setFlag($flag) {
    if (!$this->hasFlag($flag)) {
      $this->flags[] = $flag;
    }
    return $this;
  }

}
