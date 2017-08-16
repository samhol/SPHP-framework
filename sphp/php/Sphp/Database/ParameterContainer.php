<?php

/**
 * ParameterContainer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Description of ParameterContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ParameterContainer {

  /**
   * Returns the parameter handler
   *
   * @return ParameterHandler the parameter handler
   */
  public function getParams(): ParameterHandler;
}
