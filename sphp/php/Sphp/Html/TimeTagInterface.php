<?php

/**
 * TimeTagInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use DateTimeInterface;

/**
 * Defines an HTML &lt;time&gt; tag
 *
 * This implements a human-readable date/time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-03-06
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TimeTagInterface extends TagInterface {

  /**
   * Sets the datetime object
   * 
   * **Important:** Sets also the `datetime` attribute
   *
   * @param  DateTimeInterface $dateTime the datetime object
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function setDateTime(DateTimeInterface $dateTime);

  /**
   * Returns the datetime object stored to the component
   *
   * @return DateTimeInterface the datetime object
   */
  public function getDateTime();
}
