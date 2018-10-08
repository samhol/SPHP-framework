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
use Sphp\Exceptions\BadMethodCallException;
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
        'scheme' => null,
        'host' => null,
        'port' => null,
        'user' => null,
        'pass' => null,
        'path' => null,
        'query' => null,
        'fragment' => null,
    ];
    //PHP_URL_SCHEME, PHP_URL_HOST, PHP_URL_PORT, PHP_URL_USER, PHP_URL_PASS, PHP_URL_PATH, PHP_URL_QUERY or PHP_URL_FRAGMENT

    $this->parseURL("$url");
    //print_r($this->parts);
  }

  protected function parseURL(string $url) {
    $data = parse_url($url);
    if (is_array($data)) {
      $this->parts = array_merge($this->parts, $data);
    }
    $this->setQuery($this->parts['query']);
    if ($this->parts['path'] === '') {
      $this->parts['path'] = null;
    } if ($this->parts['scheme'] === '') {
      $this->parts['scheme'] = null;
    }
    $this->setReferences();
  }

  public function __clone() {
    $this->parts = \Sphp\Stdlib\Arrays::copy($this->parts);
    $this->setReferences();

    //$this = new static($this->getRaw());
  }

  private function setReferences() {
    $this->parts[PHP_URL_SCHEME] = &$this->parts['scheme'];
    $this->parts[PHP_URL_HOST] = &$this->parts['host'];
    $this->parts[PHP_URL_PORT] = &$this->parts['port'];
    $this->parts[PHP_URL_USER] = &$this->parts['user'];
    $this->parts[PHP_URL_PASS] = &$this->parts['pass'];
    $this->parts[PHP_URL_PATH] = &$this->parts['path'];
    $this->parts[PHP_URL_QUERY] = &$this->parts['query'];
    $this->parts[PHP_URL_FRAGMENT] = &$this->parts['fragment'];
    $this->parts['password'] = &$this->parts['pass'];
    $this->parts['username'] = &$this->parts['user'];
  }

  public function __call(string $name, array $arguments) {
    if (is_numeric($name)) {
      throw new BadMethodCallException("Method '$name' does not exists");
    }
    $part = lcfirst(str_replace(['get', 'set', 'has'], '', $name));
    echo "Parsed part: '$part'";
    if (array_key_exists($part, $this->parts)) {
      // echo "part '$part' exists: " . PHP_EOL;

      if (Strings::startsWith($name, 'set')) {
        // echo "setting: $part" . PHP_EOL;
        if (empty($arguments)) {
          $arguments[0] = null;
        }
        $this[$part] = $arguments[0];
        return $this;
      }
      if (Strings::startsWith($name, 'has')) {
        //echo "Checking for: $part" . PHP_EOL;
        return $this->offsetExists($part);
      }
    } else {
      throw new BadMethodCallException("Method '$name' does not exists");
    }
  }

  public function getPart($part, bool $rawurlencode = false) {
    if (!array_key_exists($part, $this->parts)) {
      throw new InvalidArgumentException("Unknown URL part '$part'");
    }
    $value = $this->parts[$part];
    if ($value instanceof QueryString) {
      return $value->getHtml();
    }
    if ($value !== null && $rawurlencode) {
      
    }
    switch ($part) {
      case 'query':
        if ($rawurlencode) {
          $value = $this->getQuery()->getHtml();
        }
        break;

      default:
        break;
    }
    $this->getQuery()->getHtml();
    if ($rawurlencode) {
      return rawurlencode($this->parts[$part]);
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
      throw new InvalidArgumentException();
    }
    if ($part === PHP_URL_QUERY) {
      return !$this->getQuery()->isEmpty();
    }
    return $this->parts[$part] !== null;
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
    return (string) $this->parts[PHP_URL_SCHEME];
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
    $this->parts[PHP_URL_SCHEME] = $scheme;
    return $this;
  }

  /**
   * Returns the `host` part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the host `part` of the URL
   */
  public function getHost(bool $encode = false): string {
    if (!$this->contains(PHP_URL_HOST)) {
      return '';
    }
    $host = $this->parts[PHP_URL_HOST];
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
      return rawurlencode($this->parts[PHP_URL_USER]);
    }
    return $this->parts[PHP_URL_USER];
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
      return rawurlencode($this->parts[PHP_URL_PASS]);
    }
    return $this->parts[PHP_URL_PASS];
  }

  /**
   * Returns the path part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the path part of the URL
   */
  public function getPath(bool $encode = false): string {
    if (!$this->contains(PHP_URL_PATH)) {
      return '';
    }
    if ($encode) {
      return preg_replace('!%2F!ui', '/', rawurlencode($this->parts[PHP_URL_PATH]));
    }
    return $this->parts[PHP_URL_PATH];
  }

  /**
   * Sets the query part of the URL
   * 
   * @param  string|QueryString $query the new query string
   * @return $this for a fluent interface
   */
  public function setQuery($query = null) {
    if ($query instanceof QueryString) {
      $this->parts['query'] = $query;
    } else {
      $this->parts['query'] = new QueryString($query);
    }
    return $this;
  }

  /**
   * Returns the query string object of the URL
   * 
   * @return QueryString the query object
   */
  public function getQuery(): QueryString {
    return $this->parts[PHP_URL_QUERY];
  }

  /**
   * Sets the port number of the URL
   * 
   * @precondition $port >= 0
   * @param  int $port
   * @return $this for a fluent interface
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function setPort(int $port) {
    $this->parts[PHP_URL_PORT] = $port;
    return $this;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return int the port number; (`-1` if the port number can not be resolved)
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function getPort(): int {
    $port = $this->parts[PHP_URL_PORT];
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
    if ($this->parts['port'] === null) {
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
    if (!$this->contains(PHP_URL_FRAGMENT)) {
      return '';
    }
    if ($encode) {
      return rawurlencode($this->parts[PHP_URL_FRAGMENT]);
    }
    return $this->parts[PHP_URL_FRAGMENT];
  }

  /**
   * Create a new iterator to iterate through the URL components
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $it = new \ArrayIterator($this->toArray());
    $it['query'] = $this->parts[PHP_URL_QUERY];
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
    if ($this->contains(PHP_URL_SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority($rawurlencode);
    $url .= $this->getPath($rawurlencode);
    if ($this->contains(PHP_URL_QUERY)) {
      $url .= '?' . $this->getQuery();
    }
    if ($this->contains(PHP_URL_FRAGMENT)) {
      $url .= '#' . $this->getFragment($rawurlencode);
    }
    return $url;
  }

  public function getAuthority(bool $rawurlencode = false): string {
    if (!$this->contains(PHP_URL_HOST)) {
      return '';
    }
    $output = '//';
    if ($this->contains(PHP_URL_USER)) {
      $output .= $this->getUser($rawurlencode);
      if ($this->contains(PHP_URL_PASS)) {
        $output .= ':' . $this->getPassword($rawurlencode);
      }
      $output .= '@';
    }
    $output .= $this->getHost($rawurlencode);
    if (!$this->hasDefaultPort()) {
      $output .= ':' . $this->parts[PHP_URL_PORT];
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
    if ($this->contains(PHP_URL_SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority($encode);
    $url .= $this->getPath($encode);
    if ($this->contains(PHP_URL_QUERY)) {
      $url .= '?' . $this->getQuery()->getHtml();
    }
    if ($this->contains(PHP_URL_FRAGMENT)) {
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
    if ($this->contains(PHP_URL_SCHEME)) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority(false);
    $url .= $this->getPath();
    if ($this->contains(PHP_URL_QUERY)) {
      $url .= '?' . $this->getQuery()->getRaw();
//$url = trim($url, '=');
    }
    if ($this->contains(PHP_URL_FRAGMENT)) {
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
    return ["scheme" => $this->parts['scheme'],
        'host' => $this->parts['host'],
        'port' => $port,
        'user' => $this->parts['user'],
        'pass' => $this->parts['pass'],
        'path' => $this->parts['path'],
        'query' => $query,
        'fragment' => $this->parts['fragment'],
    ];
  }

  public function offsetExists($offset): bool {
    if (!array_key_exists($offset, $this->parts)) {
      return false;
    }
    //$part = static::$map[$offset];
    if ($offset === 'query' || $offset === PHP_URL_QUERY) {
      return !$this->getQuery()->isEmpty();
    }
    //$offset = $this->parsePartName($offset);
    return $this->parts[$offset] !== null;
  }

  public function offsetGet($offset, bool $rawUrlEncode = false) {
    //$offset = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new InvalidArgumentException;
    }
    if ($rawUrlEncode) {
      
    }
    return $this->parts[$offset];
  }

  public function offsetSet($offset, $value) {
    //$part = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new InvalidArgumentException("'$offset' is not valid query part");
    }
    if ($offset === 'query') {
      $this->setQuery($value);
    } else {
      $this->parts[$offset] = $value;
    }
  }

  public function offsetUnset($offset) {
    //$part = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new InvalidArgumentException("'$offset' is not valid query part");
    }
    if ($offset === 'query') {
      $this->setQuery(null);
    } else {
      $this->parts[$offset] = null;
    }
  }

}
