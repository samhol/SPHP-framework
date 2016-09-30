<?php

/**
 * TagStripperFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

/**
 * Filter strips tags from the given input
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @link    http://php.net/manual/en/function.strip-tags.php
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Constructs a new instance
   * 
   * @param null|string $allowableTags optional parameter to specify tags which should not be stripped
   */
  public function __construct($allowableTags = null) {
    $this->allowableTags = $allowableTags;
  }

  /**
   * {@inheritdoc}
   * @uses    http://php.net/manual/en/function.strip-tags.php
   */
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
