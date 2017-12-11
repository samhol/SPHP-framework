<?php

/**
 * HeadingInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Flow\Headings;

/**
 * Interface represents all HTML headings and sub headings
 *
 * HTML heading Components rank in importance according to the number in their name.
 * The h1 element is said to have the highest rank, the h6 element has the lowest 
 * rank, and two elements with the same name have equal rank.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_hn.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-h1-h2-h3-h4-h5-and-h6-elements W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface HeadingInterface {

  /**
   * Returns the heading level (the priority 1-6)
   *
   * @return int heading level (the priority)
   */
  public function getLevel(): int;
}
