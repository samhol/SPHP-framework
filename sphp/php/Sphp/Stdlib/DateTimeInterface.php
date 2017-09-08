<?php

/**
 * DateTimeInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

/**
 * Description of DateTimeInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DateTimeInterface {

  public function diff(DateTimeInterface $datetime2, bool $absolute = false);

  public function format(string $format): string;

  public function getOffset();

  public function getTimestamp();

  public function getTimezone();

}
