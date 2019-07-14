<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Cookies;

/**
 * Implementation of Cookies
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Cookies {

  /**
   * Checks whether a cookie with the specified name exists
   *
   * @param  string $name the name of the cookie to check
   * @return bool whether there is a cookie with the specified name
   */
  public static function exists(string $name): bool {
    return filter_has_var(INPUT_COOKIE, $name);
  }

}
