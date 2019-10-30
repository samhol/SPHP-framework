<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;
use Sphp\Network\Utils;
/**
 * Implementation of Cookies
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Cookies {

  /** @var string name prefix indicating that the cookie must be from a secure origin (i.e. HTTPS) and the 'secure' attribute must be set */
  const PREFIX_SECURE = '__Secure-';

  /** @var string name prefix indicating that the 'domain' attribute must *not* be set, the 'path' attribute must be '/' and the effects of {@see PREFIX_SECURE} apply as well */
  const PREFIX_HOST = '__Host-';
  const HEADER_PREFIX = 'Set-Cookie: ';
  const SAME_SITE_RESTRICTION_LAX = 'Lax';
  const SAME_SITE_RESTRICTION_STRICT = 'Strict';

  /**
   * Parses the given cookie header and returns an equivalent cookie instance
   *
   * @param string $cookieHeader the cookie header to parse
   * @return Cookie|null the cookie instance or `null`
   */
  public static function parse(string $cookieHeader): ?Cookie {
    if (empty($cookieHeader)) {
      return null;
    }

    if (\preg_match('/^' . self::HEADER_PREFIX . '(.*?)=(.*?)(?:; (.*?))?$/i', $cookieHeader, $matches)) {
      $cookie = new Cookie($matches[1]);
      $cookie->setPath(null);
      $cookie->setHttpOnly(false);
      $cookie->setValue(
              \urldecode($matches[2])
      );
      $cookie->setSameSiteRestriction(null);

      if (\count($matches) >= 4) {
        $attributes = \explode('; ', $matches[3]);

        foreach ($attributes as $attribute) {
          if (\strcasecmp($attribute, 'HttpOnly') === 0) {
            $cookie->setHttpOnly(true);
          } else if (\strcasecmp($attribute, 'Secure') === 0) {
            $cookie->setSecureOnly(true);
          } else if (\stripos($attribute, 'Expires=') === 0) {
            $cookie->setExpiryTime((int) \strtotime(\substr($attribute, 8)));
          } else if (\stripos($attribute, 'Domain=') === 0) {
            $cookie->setDomain(\substr($attribute, 7));
          } else if (\stripos($attribute, 'Path=') === 0) {
            $cookie->setPath(\substr($attribute, 5));
          } else if (\stripos($attribute, 'SameSite=') === 0) {
            $cookie->setSameSiteRestriction(\substr($attribute, 9));
          }
        }
      }

      return $cookie;
    } else {
      return null;
    }
  }

  /**
   * Returns the value from the requested cookie or, if not found, the specified default value
   *
   * @param  string $name the name of the cookie to retrieve the value from
   * @param  mixed $defaultValue the default value to return if the requested cookie cannot be found
   * @return mixed the value from the requested cookie or the default value
   */
  public static function get(string $name, $defaultValue = null) {
    if (isset($_COOKIE[$name])) {
      return $_COOKIE[$name];
    } else {
      return $defaultValue;
    }
  }

  public static function calculateMaxAge(int $expiryTime): int {
    if ($expiryTime === 0) {
      return 0;
    } else {
      $maxAge = $expiryTime - \time();
      if ($maxAge < 0) {
        $maxAge = 0;
      }
      return $maxAge;
    }
  }

  public static function normalizeDomain(string $domain = null): ?string {
    // make sure that the domain is a string
    //$domain = (string) $domain;
    // if the cookie should be valid for the current host only
    if ($domain === '') {
      // no need for further normalization
      return null;
    }

    // if the provided domain is actually an IP address
    if (Utils::isValidIp($domain)) {
      // let the cookie be valid for the current host
      return null;
    }

    // for local hostnames (which either have no dot at all or a leading dot only)
    if (\strpos($domain, '.') === false || \strrpos($domain, '.') === 0) {
      // let the cookie be valid for the current host while ensuring maximum compatibility
      return null;
    }

    // unless the domain already starts with a dot
    if ($domain[0] !== '.') {
      // prepend a dot for maximum compatibility (e.g. with RFC 2109)
      $domain = '.' . $domain;
    }

    // return the normalized domain
    return $domain;
  }

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
