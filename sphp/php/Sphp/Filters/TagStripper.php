<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Filter strips tags from the given input
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/function.strip-tags.php
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TagStripper extends AbstractFilter {

  /**
   * specifies tags which should not be stripped
   *
   * @var string 
   */
  private $allowableTags;

  /**
   * Constructor
   * 
   * @param null|string $allowableTags optional parameter to specify tags which should not be stripped
   */
  public function __construct($allowableTags = null) {
    $this->allowableTags = $allowableTags;
  }

  public function filter($variable) {
    if (is_string($variable)) {
      if ($this->allowableTags !== null) {
        $variable = strip_tags($variable, $this->allowableTags);
      } else {
        $variable = strip_tags($variable);
      }
    }
    return $variable;
  }

}
