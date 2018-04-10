<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;

/**
 * Defines an Exception listener for Error dipatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * $link    http://php.net/manual/en/function.set-exception-handler.php
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface ExceptionListener {

  /**
   * 
   * @param Throwable $e
   */
  public function onException(Throwable $e);
}
