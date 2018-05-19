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
   * @var string 
   */
  private $name;

  /**
   * @var string 
   */
  private $category;

  /**
   * Constructor
   */
  public function __construct(string $name, string $category) {
    $this->name = $name;
    $this->category = $category;
  }

  public function __toString() {
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
