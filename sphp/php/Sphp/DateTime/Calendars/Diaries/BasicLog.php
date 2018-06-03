<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\Calendars\Diaries\Constraints\DateConstraint;

/**
 * Implements an abstract base class for notes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BasicLog extends AbstractLog {

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
  public function __construct(DateConstraint $constraint, string $name, string $description = null) {
    parent::__construct($constraint);
    $this->setName($name)->setDescription("$description");
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->description);
    parent::__destruct();
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
   * 
   * @param  string $name
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
  }

  public function getDescription(): string {
    return $this->description;
  }

  public function setDescription(string $description) {
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
