<?php

/**
 * Foundation.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */
namespace Sphp\Html\Foundation\Sites;
use Sphp\Html\Foundation\Sites\Media\ProgressBar;
/**
 * Description of Foundation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-03-27
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Foundation {
  /**
   * @param  int $progress
   * @param  string|null $name the name of the bar
   * @return ProgressBar
   */
  public static function progressBar(int $progress, string $name = null) :ProgressBar{
    return new ProgressBar($progress, $name);
  }
}
