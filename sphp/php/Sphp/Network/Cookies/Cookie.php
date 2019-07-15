<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Cookies;

use Sphp\Network\Headers\Header;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Network\Headers\Headers;

/**
 * Modern cookie management for PHP
 *
 * Cookies are a mechanism for storing data in the client's web browser and identifying returning clients on subsequent visits
 *
 * All cookies that have successfully been set will automatically be included in the global `$_COOKIE` array with future requests
 *
 * You can set a new cookie using the static method `Cookie::setcookie(...)` which is compatible to PHP's built-in `setcookie(...)` function
 *
 * Alternatively, you can construct an instance of this class, set properties individually, and finally call `save()`
 *
 * Note that cookies must always be set before the HTTP headers are sent to the client, i.e. before the actual output starts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Cookie implements Header {

  /** @var string name prefix indicating that the cookie must be from a secure origin (i.e. HTTPS) and the 'secure' attribute must be set */
  const PREFIX_SECURE = '__Secure-';

  /** @var string name prefix indicating that the 'domain' attribute must *not* be set, the 'path' attribute must be '/' and the effects of {@see PREFIX_SECURE} apply as well */
  const PREFIX_HOST = '__Host-';
  const HEADER_PREFIX = 'Set-Cookie: ';
  const SAME_SITE_RESTRICTION_LAX = 'Lax';
  const SAME_SITE_RESTRICTION_STRICT = 'Strict';

  /**
   * @var string the name of the cookie which is also the key for future accesses via `$_COOKIE[...]` 
   */
  private $name;

  /**
   * @var mixed|null the value of the cookie that will be stored on the client's machine 
   */
  private $value;

  /**
   * @var int the Unix timestamp indicating the time that the cookie will expire at, i.e. usually `time() + $seconds` 
   */
  private $expiryTime;

  /**
   * the path on the server that the cookie will be valid for (including all sub-directories), e.g. an empty string for the current directory or `/` for the root directory 
   * 
   * @var string 
   */
  private $path;

  /**
   * @var string|null the domain that the cookie will be valid for (including subdomains) or `null` for the current host (excluding subdomains) 
   */
  private $domain;

  /**
   * @var bool indicates that the cookie should be accessible through the HTTP protocol only and not through scripting languages 
   */
  private $httpOnly;

  /**
   * @var bool indicates that the cookie should be sent back by the client over secure HTTPS connections only 
   */
  private $secureOnly;

  /**
   * indicates that the cookie should not be sent along with cross-site requests (either `null`, `Lax` or `Strict`) 
   * 
   * @var string|null 
   */
  private $sameSiteRestriction;

  /**
   * Prepares a new cookie
   *
   * @param string $name the name of the cookie which is also the key for future accesses via `$_COOKIE[...]`
   * @throws InvalidArgumentException
   */
  public function __construct(string $name) {
    if (!Cookies::isNameValid($name)) {
      throw new InvalidArgumentException('The name of the cookie is invalid');
    }
    $this->name = $name;
    $this->value = null;
    $this->expiryTime = 0;
    $this->path = '/';
    $this->domain = null;
    $this->httpOnly = true;
    $this->secureOnly = false;
    $this->sameSiteRestriction = self::SAME_SITE_RESTRICTION_LAX;
  }

  /**
   * Returns the name of the cookie
   *
   * @return string the name of the cookie which is also the key for future accesses via `$_COOKIE[...]`
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Returns the value of the cookie
   *
   * @return mixed|null the value of the cookie that will be stored on the client's machine
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Sets the value for the cookie
   *
   * @param  mixed|null $value the value of the cookie that will be stored on the client's machine
   * @return $this for a fluent interface
   */
  public function setValue($value) {
    $this->value = $value;

    return $this;
  }

  /**
   * Returns the expiry time of the cookie
   *
   * @return int the Unix timestamp indicating the time that the cookie will expire at, i.e. usually `time() + $seconds`
   */
  public function getExpiryTime(): int {
    return $this->expiryTime;
  }

  /**
   * Sets the expiry time for the cookie
   *
   * @param int $expiryTime the Unix timestamp indicating the time that the cookie will expire at, i.e. usually `time() + $seconds`
   * @return $this for a fluent interface
   */
  public function setExpiryTime(int $expiryTime) {
    $this->expiryTime = $expiryTime;
    return $this;
  }

  /**
   * Returns the maximum age of the cookie (i.e. the remaining lifetime)
   *
   * @return int the maximum age of the cookie in seconds
   */
  public function getMaxAge(): int {
    return $this->expiryTime - \time();
  }

  /**
   * Sets the expiry time for the cookie based on the specified maximum age (i.e. the remaining lifetime)
   *
   * @param int $maxAge the maximum age for the cookie in seconds
   * @return $this for a fluent interface
   */
  public function setMaxAge(int $maxAge) {
    $this->expiryTime = \time() + $maxAge;
    return $this;
  }

  /**
   * Returns the path of the cookie
   *
   * @return string the path on the server that the cookie will be valid for (including all sub-directories), e.g. an empty string for the current directory or `/` for the root directory
   */
  public function getPath(): string {
    return $this->path;
  }

  /**
   * Sets the path for the cookie
   *
   * @param  string $path the path on the server that the cookie will be valid for (including all sub-directories), e.g. an empty string for the current directory or `/` for the root directory
   * @return $this for a fluent interface
   */
  public function setPath(string $path) {
    $this->path = $path;

    return $this;
  }

  /**
   * Returns the domain of the cookie
   *
   * @return string|null the domain that the cookie will be valid for (including subdomains) or `null` for the current host (excluding subdomains)
   */
  public function getDomain(): ?string {
    return $this->domain;
  }

  /**
   * Sets the domain for the cookie
   *
   * @param string|null $domain the domain that the cookie will be valid for (including subdomains) or `null` for the current host (excluding subdomains)
   * @return $this for a fluent interface
   */
  public function setDomain(string $domain = null) {
    $this->domain = Cookies::normalizeDomain($domain);

    return $this;
  }

  /**
   * Returns whether the cookie should be accessible through HTTP only
   *
   * @return bool whether the cookie should be accessible through the HTTP protocol only and not through scripting languages
   */
  public function isHttpOnly(): bool {
    return $this->httpOnly;
  }

  /**
   * Sets whether the cookie should be accessible through HTTP only
   *
   * @param bool $httpOnly indicates that the cookie should be accessible through the HTTP protocol only and not through scripting languages
   * @return $this for a fluent interface
   */
  public function setHttpOnly(bool $httpOnly) {
    $this->httpOnly = $httpOnly;
    return $this;
  }

  /**
   * Returns whether the cookie should be sent over HTTPS only
   *
   * @return bool whether the cookie should be sent back by the client over secure HTTPS connections only
   */
  public function isSecureOnly(): bool {
    return $this->secureOnly;
  }

  /**
   * Sets whether the cookie should be sent over HTTPS only
   *
   * @param  bool $secureOnly indicates that the cookie should be sent back by the client over secure HTTPS connections only
   * @return $this for a fluent interface
   */
  public function setSecureOnly(bool $secureOnly) {
    $this->secureOnly = $secureOnly;
    return $this;
  }

  /**
   * Returns the same-site restriction of the cookie
   *
   * @return string|null whether the cookie should not be sent along with cross-site requests (either `null`, `Lax` or `Strict`)
   */
  public function getSameSiteRestriction(): ?string {
    return $this->sameSiteRestriction;
  }

  /**
   * Sets the same-site restriction for the cookie
   *
   * @param string|null $sameSiteRestriction indicates that the cookie should not be sent along with cross-site requests (either `null`, `Lax` or `Strict`)
   * @return $this for a fluent interface
   */
  public function setSameSiteRestriction(string $sameSiteRestriction = null) {
    $this->sameSiteRestriction = $sameSiteRestriction;
    return $this;
  }

  /**
   * Saves the cookie
   *
   * @return bool whether the cookie header has successfully been sent (and will *probably* cause the client to set the cookie)
   */
  public function save(): bool {
   return setcookie($this->name, $this->getValue(), $this->getExpiryTime(), $this->getPath(), $this->getDomain(), $this->isSecureOnly(), $this->isHttpOnly());

    //return Headers::addHttpHeader((string) $this);
  }

  /**
   * Deletes the cookie
   *
   * @return bool whether the cookie header has successfully been sent (and will *probably* cause the client to delete the cookie)
   */
  public function delete(): bool {
    // create a temporary copy of this cookie so that it isn't corrupted
    $copiedCookie = clone $this;
    // set the copied cookie's value to an empty string which internally sets the required options for a deletion
    $copiedCookie->setValue('');

    // save the copied "deletion" cookie
    return $copiedCookie->save();
  }

  public function __toString(): string {
    return Cookies::buildCookieHeader($this->name, $this->value, $this->expiryTime, $this->path, $this->domain, $this->secureOnly, $this->httpOnly, $this->sameSiteRestriction);
  }

}
