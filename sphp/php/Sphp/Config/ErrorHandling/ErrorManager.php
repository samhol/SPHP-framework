<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

/**
 * The ErrorManager class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorManager {

  private int $oldLevel;
  private ?int $new;

  public function __construct() {
    $this->oldLevel = error_reporting();
    $this->new = null;
  }

  /**
   * Sets which PHP errors are reported
   * 
   * @param  int $level PHP error level
   * @return $this for a fluent interface
   */
  public function start(int $level) {
    if ($level !== $this->oldLevel) {
      $this->new = error_reporting($level);
    }
    return $this;
  }

  /**
   * Restores which PHP errors are reported
   * 
   * @return $this for a fluent interface
   */
  public function stop() {
    if (isset($this->new)) {
      error_reporting($this->oldLevel);
      $this->new = null;
    }
    return $this;
  }

}
