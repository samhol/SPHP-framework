<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Networks;

use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Datastructures\Arrayable;
use IteratorAggregate;
use Traversable;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an URL object for manipulation and comparison
 *
 * Keys for url manipulation via ArrayAccess interface: 
 * 
 * * PHP_URL_SCHEME
 * * PHP_URL_HOST
 * * PHP_URL_PORT
 * * PHP_URL_USER
 * * PHP_URL_PASS
 * * PHP_URL_PATH
 * * PHP_URL_QUERY
 * * PHP_URL_FRAGMENT
 * 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class URL implements Arrayable, IteratorAggregate, \JsonSerializable, \ArrayAccess {

  const SCHEME = PHP_URL_SCHEME;
  const HOST = PHP_URL_HOST;
  const PORT = PHP_URL_PORT;
  const USER = PHP_URL_USER;
  const PASS = PHP_URL_PASS;
  const PATH = PHP_URL_PATH;
  const QUERY = PHP_URL_QUERY;
  const FRAGMENT = PHP_URL_FRAGMENT;

  private static $map = [
      'scheme' => PHP_URL_SCHEME,
      'host' => PHP_URL_HOST,
      'port' => PHP_URL_PORT,
      'user' => PHP_URL_USER,
      'username' => PHP_URL_USER,
      'password' => PHP_URL_PASS,
      'pass' => PHP_URL_PASS,
      'path' => PHP_URL_PATH,
      'query' => PHP_URL_QUERY,
      'fragment' => PHP_URL_FRAGMENT,
  ];

  /**
   * the current URL object
   *
   * @var URL 
   */
  private static $currUrl;

  /**
   * URL parts
   *
   * @var array
   */
  private $parts = [];

  /**
   * Constructor
   *
   * @param string|null $url the URL string
   */
  public function __construct(string $url = null) {
    $this->parts = [
        self::SCHEME => null,
        self::HOST => null,
        self::PORT => null,
        self::USER => null,
        self::PASS => null,
        self::PATH => null,
        self::QUERY => new QueryString(),
        self::FRAGMENT => null,
    ];

    // var_dump(PHP_URL_PORT ,parse_url($url));
    if ($url !== null) {
      $this->parseURL($url);
    }
  }

  protected function parseURL(string $url) {
    $this->setPart(self::SCHEME, parse_url($url, PHP_URL_SCHEME));
    $this->setPart(self::HOST, parse_url($url, PHP_URL_HOST));
    $this->setPart(self::PORT, parse_url($url, PHP_URL_PORT));
    $this->setPart(self::USER, parse_url($url, PHP_URL_USER));
    $this->setPart(self::PASS, parse_url($url, PHP_URL_PASS));
    $this->setPart(self::PATH, parse_url($url, PHP_URL_PATH));
    $this->setPart(self::QUERY, parse_url($url, PHP_URL_QUERY));
    $this->setPart(self::FRAGMENT, parse_url($url, PHP_URL_FRAGMENT));
  }

  public function __clone() {
    $this->parts = \Sphp\Stdlib\Arrays::copy($this->parts);
  }

  public function partToString(int $part, bool $rawurlencode = false): string {
    if (!array_key_exists($part, $this->parts)) {
      throw new InvalidArgumentException("Unknown URL part '$part'");
    }
    $value = $this->parts[$part];
    if ($part === PHP_URL_QUERY) {
      if ($rawurlencode) {
        return $value->build('&amp;', PHP_QUERY_RFC3986);
      } else {
        return $value->build('&amp;', PHP_QUERY_RFC1738);
      }
    } else if ($part === PHP_URL_QUERY) {
      
    }
    return $this->parts[$part];
  }

  /**
   * Checks whether the part of the URL is set or not
   * 
   * @param  int $part
   * @return boolean true if the part is set and false otherwise
   * @throws InvalidArgumentException
   */
  public function contains(int $part): bool {
    if (!array_key_exists($part, $this->parts)) {
      throw new InvalidArgumentException("Unknown URL part '$part'");
    }
    if ($part === self::QUERY) {
      return !$this->getQuery()->isEmpty();
    }
    return $this->parts[$part] !== null;
  }

  /**
   * Checks whether the part of the URL is set or not
   * 
   * @param  int $part
   * @param  mixed $value
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setPart(int $part, $value) {
    if (!array_key_exists($part, $this->parts)) {
      throw new InvalidArgumentException("Unknown URL part '$part'");
    }
    if ($part === self::QUERY) {
      $this->setQuery($value);
    } else if ($part === self::PORT) {
      if (!is_int($value) && $value !== null) {
        throw new InvalidArgumentException("Invalid URL port $value");
      }
      $this->parts[$part] = $value;
    } else if ($part === self::SCHEME) {
      if ($value !== null) {
        $value = strtolower($value);
      }
      $this->parts[self::SCHEME] = $value;
    } else if (is_string($value) || $value === null) {
      if ($value === '') {
        $value = null;
      }
      $this->parts[$part] = $value;
    } else {
      $v = var_export($value, true);
      throw new InvalidArgumentException("Something went wrong $part, $v");
    }
    return $this;
  }

  /**
   * Returns the scheme name of the URL
   * 
   * The scheme is usually the name of a protocol, defines how the resource 
   * will be obtained. Examples include `http`, `https`, `ftp`, `file` and many 
   * others. **All schemes are transformed to lowercase.**
   * 
   * @return string the scheme name of the URL
   */
  public function getScheme(): string {
    return (string) $this->parts[self::SCHEME];
  }

  /**
   * Sets the scheme name (service name) of the URL
   * 
   * * **All schemes are transformed to lowercase.**
   * * The scheme is usually the name of a protocol, defines how the resource will be obtained.
   * * Supported service names: `http`, `https`, `ftp`, `ssh`, `telnet`, `imap`, `smtp`, `nicname`, `gopher`, `finger`, `pop3` and `www`
   *  
   * 
   * @param  string|null $scheme the scheme name of the URL
   * @return $this for a fluent interface
   */
  public function setScheme(string $scheme = null) {
    if ($scheme !== null) {
      $scheme = strtolower($scheme);
    }
    $this->parts[self::SCHEME] = $scheme;
    return $this;
  }

  /**
   * Returns the `host` part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the host `part` of the URL
   */
  public function getHost(bool $encode = false): string {
    if (!$this->contains(self::HOST)) {
      return '';
    }
    $host = $this->parts[self::HOST];
    if (preg_match('!^[\da-f]*:[\da-f.:]+$!ui', $host)) {
      $host = '[' . $host . ']'; // IPv6
    } else if ($encode) {
      $host = rawurlencode($host); // IPv4 or name
    }
    return $host;
  }

  /**
   * Returns the user part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the user part of the URL
   */
  public function getUser(bool $encode = false): string {
    if (!$this->contains(PHP_URL_USER)) {
      return '';
    }
    if ($encode) {
      return rawurlencode($this->parts[self::USER]);
    }
    return $this->parts[self::USER];
  }

  /**
   * Returns the password part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the password part of the URL
   */
  public function getPassword(bool $encode = false): string {
    if (!$this->contains(PHP_URL_PASS)) {
      return '';
    }
    if ($encode) {
      return rawurlencode($this->parts[self::PASS]);
    }
    return $this->parts[self::PASS];
  }

  /**
   * Returns the path part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the path part of the URL
   */
  public function getPath(bool $encode = false): string {
    if (!$this->contains(self::PATH)) {
      return '';
    }
    if ($encode) {
      return preg_replace('!%2F!ui', '/', rawurlencode($this->parts[self::PATH]));
    }
    return $this->parts[self::PATH];
  }

  /**
   * Sets the query part of the URL
   * 
   * @param  string|QueryString $query the new query string
   * @return $this for a fluent interface
   */
  public function setQuery($query = null) {
    if ($query instanceof QueryString) {
      $this->parts[self::QUERY] = $query;
    } else {
      $this->parts[self::QUERY] = new QueryString($query);
    }
    return $this;
  }

  /**
   * Returns the query string object of the URL
   * 
   * @return QueryString the query object
   */
  public function getQuery(): QueryString {
    return $this->parts[self::QUERY];
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return int the port number; (`-1` if the port number can not be resolved)
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function getPort(): int {
    $port = $this->parts[self::PORT];
    if ($port === null) {
      $port = getservbyname($this->getScheme(), 'tcp');
      if ($port === false) {
        throw new RuntimeException('Cannot resolve port from the URL');
      }
    }
    return $port;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return boolean true if the port number is the default for the scheme
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function hasDefaultPort(): bool {
    if ($this->parts[self::PORT] === null) {
      return true;
    }
    return getservbyname($this->getScheme(), 'tcp') === $this->getPort();
  }

  /**
   * Returns the fragment identifier of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the fragment identifier of the URL
   */
  public function getFragment(bool $encode = false) {
    if (!$this->contains(self::FRAGMENT)) {
      return '';
    }
    if ($encode) {
      return rawurlencode($this->parts[self::FRAGMENT]);
    }
    return $this->parts[self::FRAGMENT];
  }

  /**
   * Create a new iterator to iterate through the URL components
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $it = new \ArrayIterator($this->toArray());
    $it['query'] = $this->parts[self::QUERY];
    return $it;
  }

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  string|URL $url the URL to compare with the current URL
   * @return boolean true if the specified URL is equal to the current URL, otherwise false
   */
  public function equals($url): bool {
    if (!($url instanceof URL)) {
      $url = new URL($url);
    }
    //print_r($this->toArray());
    //print_r($url->toArray());
    return $this->toArray() == $url->toArray();
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * **String format:** 
   * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
   *
   * @return string representation of the object
   */
  public function __toString(): string {
    return $this->getHtml();
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * **String format:** 
   * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
   *
   * @return string representation of the object
   */
  public function toString(bool $rawurlencode = false): string {
    $url = '';
    $encode = true;
    if ($this->contains(self::SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority($rawurlencode);
    $url .= $this->getPath($rawurlencode);
    if ($this->contains(self::QUERY)) {
      $url .= '?' . $this->getQuery();
    }
    if ($this->contains(self::FRAGMENT)) {
      $url .= '#' . $this->getFragment($rawurlencode);
    }
    return $url;
  }

  public function getAuthority(bool $rawurlencode = false): string {
    if (!$this->contains(self::HOST)) {
      return '';
    }
    $output = '//';
    if ($this->contains(self::USER)) {
      $output .= $this->getUser($rawurlencode);
      if ($this->contains(self::PASS)) {
        $output .= ':' . $this->getPassword($rawurlencode);
      }
      $output .= '@';
    }
    $output .= $this->getHost($rawurlencode);
    if (!$this->hasDefaultPort()) {
      $output .= ':' . $this->parts[self::PORT];
    }
    return $output;
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * **String format:** 
   * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
   *
   * @return string representation of the object
   */
  public function getHtml(): string {
    $url = '';
    $encode = true;
    if ($this->contains(self::SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority($encode);
    $url .= $this->getPath($encode);
    if ($this->contains(self::QUERY)) {
      $url .= '?' . $this->getQuery()->getHtml();
    }
    if ($this->contains(self::FRAGMENT)) {
      $url .= '#' . $this->getFragment($encode);
    }
    return $url;
  }

  /**
   * Returns the object as a raw unencoded string
   *
   * **String format:** 
   * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
   *
   * @return string representation of the object
   */
  public function getRaw(): string {
    $url = '';
    if ($this->contains(self::SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority(false);
    $url .= $this->getPath();
    if ($this->contains(self::QUERY)) {
      $url .= '?' . $this->getQuery()->getRaw();
//$url = trim($url, '=');
    }
    if ($this->contains(self::FRAGMENT)) {
      $url .= '#' . $this->getFragment();
    }
    return $url;
  }

  /**
   * Checks whether the URL is current browser URL or not 
   * 
   * @return boolen true if the URL is current browser URL, false otherwise
   * @codeCoverageIgnore
   */
  public function isCurrent(): bool {
    return $this->equals(URL::getCurrent());
  }

  public function jsonSerialize(): array {
    return get_object_vars($this->parts);
  }

  /**
   * Returns the current URL as an object
   *
   * @return string the current URL
   * @codeCoverageIgnore
   */
  public static function getCurrentURL(int $flags = 0): string {
    $port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_SANITIZE_NUMBER_INT);
    $httpsStatus = filter_input(INPUT_SERVER, 'HTTPS', FILTER_SANITIZE_STRING);
    $serverName = filter_input(INPUT_SERVER, 'SERVER_NAME', FILTER_SANITIZE_STRING);
    $currentURL = ($httpsStatus === 'on') || $port === 443 ? 'https://' : 'http://';
    $currentURL .= $serverName;
    if ($port !== 80 && ($port !== 443 && $httpsStatus === 'on')) {
      $currentURL .= ":$port";
    }
    $reqUri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
    $currentURL .= $reqUri;
    if ($flags > 0) {
      $currentURL = htmlentities($currentURL, $flags);
    }
    return $currentURL;
  }

  /**
   * Returns the current URL as an object
   *
   * @return URL the current URL as an object
   * @codeCoverageIgnore
   */
  public static function getCurrent(): URL {
    if (self::$currUrl === null) {
      $url = new static(static::getCurrentURL());

      self::$currUrl = $url;
    }
    return clone self::$currUrl;
  }

  public function toArray(): array {
    try {
      $port = $this->getPort();
    } catch (\Exception $ex) {
      $port = null;
    }
    if ($this->getQuery()->isEmpty()) {
      $query = null;
    } else {
      $query = $this->getQuery()->toArray();
    }
    return ["scheme" => $this->parts[self::SCHEME],
        'host' => $this->parts[self::HOST],
        'port' => $port,
        'user' => $this->parts[self::USER],
        'pass' => $this->parts[self::PASS],
        'path' => $this->parts[self::PATH],
        'query' => $query,
        'fragment' => $this->parts[self::FRAGMENT],
    ];
  }

  private function getIndex($offset): int {
    if (array_key_exists($offset, $this->parts)) {
      return $offset;
    } else if (is_string($offset) && array_key_exists($offset, self::$map)) {
      return self::$map[$offset];
    }
    throw new InvalidArgumentException("Invalid index value $offset");
  }

  public function offsetExists($offset): bool {
    $index = $this->getIndex($offset);
    return $this->contains($index);
  }

  public function offsetGet($offset) {
    $index = $this->getIndex($offset);
    return $this->parts[$index];
  }

  public function offsetSet($offset, $value) {
    $index = $this->getIndex($offset);
    $this->setPart($index, $value);
    //echo "$offset: $index = $value sets" . PHP_EOL;
    //var_dump($this->parts[$index]);
  }

  public function offsetUnset($offset) {
    $index = $this->getIndex($offset);
    if ($index === self::QUERY) {
      $this->setQuery(null);
    } else {
      $this->parts[$index] = null;
    }
  }

}
