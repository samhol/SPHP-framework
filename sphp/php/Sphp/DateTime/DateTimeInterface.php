<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Defines properties for a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface DateTimeInterface extends DateInterface, TimeInterface {

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws DateTimeException if formatting fails
   */
  public function format(string $format): string;

}
