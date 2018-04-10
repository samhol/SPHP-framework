<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use DateTimeInterface;

/**
 * Defines an HTML &lt;time&gt; tag
 *
 * This implements a human-readable date/time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TimeTagInterface extends TagInterface {

  /**
   * Sets the datetime object
   * 
   * **Important:** Sets also the `datetime` attribute
   *
   * @param  DateTimeInterface $dateTime the datetime object
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function setDateTime(DateTimeInterface $dateTime);

  /**
   * Returns the datetime object stored to the component
   *
   * @return DateTimeInterface the datetime object
   */
  public function getDateTime(): DateTimeInterface;
}
