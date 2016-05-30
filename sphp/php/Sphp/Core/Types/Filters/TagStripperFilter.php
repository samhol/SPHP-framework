<?php

/**
 * TagStripperFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types\Filters;

/**
 * Filter strips tags from the given input
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TagStripperFilter extends AbstractStringFilter {

  /**
   * specifies tags which should not be stripped
   *
   * @var string 
   */
  private $allowableTags;

  /**
   * Constructs a new {@link self} object
   * 
   * @param null|string $allowableTags optional parameter to specify tags which should not be stripped
   */
  public function __construct($allowableTags = null) {
    $this->allowableTags = $allowableTags;
    parent::__construct();
  }

  /**
   * Strips HTML and PHP tags from the string
   * 
   * @param  string|String $value optional parameter to specify tags which should not be stripped
   * @return self for PHP Method Chaining
   * @see    http://php.net/manual/en/function.strip-tags.php
   */
  protected function runFilter($value) {
    if ($this->allowableTags !== null) {
      $value = strip_tags($value, $this->allowableTags);
    } else {
      $value = strip_tags($value);
    }
    return $value;
  }

}
