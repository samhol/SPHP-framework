<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

//use Sphp\Network\Headers\Header;
use Sphp\Exceptions\InvalidArgumentException;

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

  /**
   * the name of the cookie which is also the key for future accesses via 
   * `$_COOKIE[...]` 
   * 
   * @var string
   */
  private $name;

  /**
   * the value of the cookie that will be stored on the client's machine 
   * 
   * @var mixed|null
   */
  private $value;

  /**
   * the Unix timestamp indicating the time that the cookie will expire at, i.e. 
   * usually `time() + $seconds` 
   * 
   * @var int
   */
  private $expiryTime;

  /**
   * the path on the server that the cookie will be valid for (including all 
   * sub-directories), e.g. an empty string for the current directory or `/` 
   * for the root directory 
   * 
   * @var string 
   */
  private $path;

  /**
   * the domain that the cookie will be valid for (including 
   * subdomains) or `null` for the current host (excluding subdomains) 
   * 
   * @var string|null 
   */
  private $domain;

  /**
   * @var bool indicates that the cookie should be accessible through the HTTP 
   * protocol only and not through scripting languages 
   */
  private $httpOnly;

  /**
   * indicates that the cookie should be sent back by the client over 
   * secure HTTPS connections only 
   * 
   * @var bool 
   */
  private $secureOnly;

  /**
   * indicates that the cookie should not be sent along with cross-site requests 
   * (either `null`, `Lax` or `Strict`) 
   * 
   * @var string|null 
   */
  private $sameSiteRestriction;

  /**
   * Prepares a new cookie
   *
   * @param string $name the name of the cookie which is also the key for future accesses via `$_COOKIE[...]`
   * @throws InvalidArgumentException if The name of the cookie is invalid
   */
  public function __construct(string $name) {
    if (!Cookies::isNameValid($name)) {
      throw new InvalidArgumentException('The name of the cookie is invalid');
    }
    $this->name = $name;
    $this->value = null;
    $this->expiryTime = 0;
    $this->path = '';
    $this->domain = null;
    $this->httpOnly = false;
    $this->secureOnly = false;
    $this->sameSiteRestriction = null;
  }

  public function __toString(): string {
    $forceShowExpiry = false;
    $value = $this->getValue();
    if ((string) $value === '') {
      $value = 'deleted';
      $expiryTime = 0;
      $maxAge = 0;
      $forceShowExpiry = true;
    } else {
      $expiryTime = $this->getExpiryTime();
      $maxAge = $this->getMaxAge();
    }
    $headerStr = 'Set-Cookie: ' . $this->getName() . '=' . \urlencode($value);
    $headerStr .= '; expires=' . \gmdate('D, d-M-Y H:i:s T', $expiryTime);
    $headerStr .= '; Max-Age=' . $maxAge;
    if ($this->getPath() !== null) {
      $headerStr .= '; path=' . $this->getPath();
    }
    if ($this->getDomain() !== null) {
      $headerStr .= '; domain=' . $this->getDomain();
    }
    if ($this->isSecureOnly()) {
      $headerStr .= '; secure';
    }

    if ($this->isHttpOnly()) {
      $headerStr .= '; httponly';
    }
    $sameSiteRestriction = $this->getSameSiteRestriction();
    if ($sameSiteRestriction === 'Lax' || $sameSiteRestriction === 'Strict') {
      $headerStr .= "; SameSite=$sameSiteRestriction";
    }
    return $headerStr;
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
    $maxAge = $this->getExpiryTime() - \time();
    if ($maxAge < 0) {
      $maxAge = 0;
    }
    return $maxAge;
  }

  /**
   * Sets the expiry time for the cookie based on the specified maximum age (i.e. the remaining lifetime)
   *
   * @param int $maxAge the maximum age for the cookie in seconds
   * @return $this for a fluent interface
   */
  public function setMaxAge(int $maxAge) {
    $this->setExpiryTime(\time() + $maxAge);
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
  public function setPath(string $path = '/') {
    $this->path = $path;
    return $this;
  }

  /**
   * Returns the domain of the cookie
   *
   * @return string the domain that the cookie will be valid for (including subdomains) or `null` for the current host (excluding subdomains)
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
    $this->domain = $domain;
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
    if ($this->getSameSiteRestriction() === null) {
      return setcookie($this->name, $this->getValue(), $this->getExpiryTime(), $this->getPath(), $this->getDomain(), $this->isSecureOnly(), $this->isHttpOnly());
    } else {
      return Headers::addHttpHeader((string) $this);
    }
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

}
