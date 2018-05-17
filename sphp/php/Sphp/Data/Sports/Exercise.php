<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Sphp\DateTime\DateInterface;

/**
 * Implements a http code
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Exercise {

  /**
   * @var DateInterface 
   */
  private $date;

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
   */
  public function __construct(DateInterface $date, string $name, string $category) {
    $this->date = $date;
    $this->name = $name;
    $this->description = $category;
  }

  /**
   * Returns the exercise date
   * 
   * @return DateInterface exercise date
   */
  public function getDate(): DateInterface {
    return $this->date;
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
    return $this->description;
  }
  
  public function __toString() {
    return $this->date->format('Y-m-d') . ": $this->name";
  }

}
