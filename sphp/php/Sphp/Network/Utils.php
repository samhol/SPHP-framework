<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network;

/**
 * Description of Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Utils {

  /**
   * Returns the client IP
   * 
   * <ul>
   * <li>whether ip is from share internet</li>
   * <li>whether ip is from proxy</li>
   * <li>whether ip is from remote address</li>
   * </ul>
   * 
   * @return string|null the client IP
   */
  public static function getClientIp(): ?string {
    $ip = null;
    if (filter_has_var(INPUT_SERVER, 'HTTP_CLIENT_IP')) {
      $ip = filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP', FILTER_SANITIZE_STRING);
    } else if (filter_has_var(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR')) {
      $ip = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR', FILTER_SANITIZE_STRING);
    } else if (filter_has_var(INPUT_SERVER, 'REMOTE_ADDR')) {
      $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
    }
    return $ip;
  }

  public static function isValidIp(string $domain): bool {
    return \filter_var($domain, \FILTER_VALIDATE_IP) !== false;
  }

  public static function getHttpUserAgent(): string {
    return $_SERVER['HTTP_USER_AGENT'];
  }

  /**
   * Checks whether a cookie with the specified name exists
   *
   * @param  string $name the name of the cookie to check
   * @return bool whether there is a cookie with the specified name
   */
  public static function cookieExists(string $name): bool {
    return filter_has_var(INPUT_COOKIE, $name);
  }

}
