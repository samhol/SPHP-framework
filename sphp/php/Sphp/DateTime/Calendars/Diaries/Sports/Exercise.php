<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

/**
 * Implements an exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Exercise {

  /**
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $category;

  /**
   * Constructor
   * 
   * @param string $name the name of the exercise
   * @param string $category the category of the exercise
   */
  public function __construct(string $name, string $category) {
    $this->name = $name;
    $this->category = $category;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name, $this->category);
  }

  public function __toString(): string {
    return "$this->name: ($this->category)";
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
   * @return string
   */
  public function getDescription(): string {
    return $this->category;
  }

}
