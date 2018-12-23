<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime;

use Sphp\Html\Tag;
use DateTimeInterface;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Defines an HTML &lt;time&gt; tag
 *
 * This implements a human-readable date/time
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface TimeTagInterface extends Tag {

  /**
   * the year only
   */
  const YEAR = 'Y';

  /**
   * year and month 
   */
  const Y_M = 'Y-m';

  /**
   * year, month and day 
   */
  const Y_M_D = 'Y-m-d';

  /**
   * week of year
   */
  const Y_W = 'Y-\WW';

  /**
   * month and day of any year
   */
  const M_D = 'm-d';

  /**
   * full date and time with offset
   */
  const DATE_TIME = 'Y-m-d H:i:sO';

  /**
   * Sets the datetime value
   * 
   * @param  DateTimeInterface $dateTime the datetime object
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if formatting fails
   * @link   http://www.w3schools.com/tags/att_time_datetime.asp datetime attribute
   */
  public function setDateTime($dateTime);

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return $this for a fluent interface
   */
  public function setFormat(string $format = self::DATE_TIME);
  
  /**
   * Returns the date format used
   * 
   * @return  string the date format used
   */
  public function getFormat(): string;
}
