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
 * @methtod string getScheme() Returns the scheme name 
 * @metthod string getHost(bool $rawurlencode = false) Returns the scheme name 
 * @metthod string getUser(bool $rawurlencode = false) Returns the username part of the URL
 * @metthod string getPassword(bool $rawurlencode = false) Returns the password part of the URL
 * @metthod string getPath(bool $rawurlencode = false) Returns the path part of the URL
 * @metthod string getFragment(bool $rawurlencode = false) Returns the fragment part of the URL
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
  private static $map = [
      'scheme' => 'scheme',
      PHP_URL_SCHEME => 'scheme',
      'host' => 'host',
      PHP_URL_HOST => 'host',
      'port' =>  'port',
      PHP_URL_PORT => 'port',
      'user' =>  'user', 
      'username' =>  'user',
      PHP_URL_USER =>  'user',
      'pass' =>  'pass',
      'password' =>  'pass',
      PHP_URL_PASS =>  'pass',
      'path' => 'path',
      PHP_URL_PATH => 'path',
      'query' =>  'query',
      PHP_URL_QUERY => 'query',
      'fragment' =>  'fragment',
      PHP_URL_FRAGMENT => 'fragment'
      ];

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
  }

  protected function parseURL(string $url) {
    $this->parts = array_merge($this->parts, parse_url($url));
    $this->setQuery($this->parts['query']);
    if ($this->parts['path'] === '') {
      $this->parts['path'] = null;
    }
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

  public function __clone() {
    //$this = new static($this->getRaw());
  }

  public function __call(string $name, array $arguments) {
    if (is_numeric($name)) {
      throw new BadMethodCallException("Method '$name' does not exists");
    }
    $part = lcfirst(str_replace(['get', 'set', 'has'], '', $name));
    //echo "Parsed part: '$part'";
    if (array_key_exists($part, $this->parts)) {
      // echo "part '$part' exists: " . PHP_EOL;
      if (Strings::startsWith($name, 'get')) {
        // echo "getting: $part" . PHP_EOL;
        if (!empty($arguments)) {
          return $this->getPart($part, (bool) $arguments[0]);
        } else {
          return $this->getPart($part);
        }
      }
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

  public function getPart(string $part, bool $rawurlencode = false) {
    if (array_key_exists($part, $this->parts)) {
      $value = $this->parts[$part];
    }
    if (!array_key_exists($part, $this->parts)) {
      throw new InvalidArgumentException("Unknown URL part '$part'");
    }
    $value = $this->parts[$part];
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

  public function setPart(string $part, $value) {
    switch ($part) {
      case 'scheme':
        if ($value !== null) {
          $scheme = strtolower("$value");
        }

        break;

      default:
        break;
    }
  }

  public function containsPart(string $part) {
    
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
      $scheme = strtolower("$scheme");
    }
    $this->parts['scheme'] = $scheme;
    return $this;
  }

  /**
   * Sets the query part of the URL
   * 
   * @param  string|QueryString $query the new query string
   * @return $this for a fluent interface
   */
  public function setQuery($query = null) {
    if (is_string($query)) {
      $this->parts['query'] = new QueryString($query);
    } else if ($query instanceof QueryString) {
      $this->parts['query'] = $query;
    } else {
      $this->parts['query'] = new QueryString();
    }
    return $this;
  }

  /**
   * Checks whether the `query` part of the URL is set or not
   * 
   * @return boolean true if the query is set and false otherwise
   */
  public function hasQuery(): bool {
    return !$this->getQuery()->isEmpty();
  }

  /**
   * Returns the query string object of the URL
   * 
   * @return QueryString the query object
   */
  public function getQuery(): QueryString {
    return $this->parts['query'];
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
    $this->parts['port'] = $port;
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
    $port = $this->parts['port'];
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
   * Create a new iterator to iterate through the URL components
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new \ArrayIterator($this->toArray());
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
    print_r($this->toArray());
    print_r($url->toArray());
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

  public function getAuthority(): string {
    $output = '';
    if ($this->hasHost()) {
      $output .= '//';
      if ($this->hasUser()) {
        $output .= rawurlencode($this->parts['user']);
        if ($this->hasPassword()) {
          $output .= ':' . rawurlencode($this->parts['pass']);
        }
        $output .= '@';
      }
      $host = $this->parts['host'];
      if (preg_match('!^[\da-f]*:[\da-f.:]+$!ui', $host)) {
        $output .= '[' . $host . ']'; // IPv6
      } else {
        $output .= rawurlencode($host); // IPv4 or name
      }
      if ($this->parts['port'] !== null) {
        $port = $this->parts['port'];
        if (!$this->hasDefaultPort()) {
          $output .= ':' . $port;
        }
      }
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
    if ($this->hasScheme()) {
      $url .= rawurlencode($this->parts['scheme']) . ':';
    }
    if ($this->hasHost()) {
      $url .= '//';
      if ($this->hasUser()) {
        $url .= rawurlencode($this->parts['user']);
        if ($this->hasPassword()) {
          $url .= ':' . rawurlencode($this->parts['pass']);
        }
        $url .= '@';
      }
      $host = $this->parts['host'];
      if (preg_match('!^[\da-f]*:[\da-f.:]+$!ui', $host)) {
        $url .= '[' . $host . ']'; // IPv6
      } else {
        $url .= rawurlencode($host); // IPv4 or name
      }
      if ($this->parts['port'] !== null) {
        $port = $this->parts['port'];
        if (!$this->hasDefaultPort()) {
          $url .= ':' . $port;
        }
      }
    }
    $url .= $this->getPath($encode);
    if ($this->hasQuery()) {
      $url .= '?' . $this->getQuery()->getHtml();
    }
    if ($this->hasFragment()) {
      $url .= '#' . $this->getPart('fragment', true);
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
    if ($this->hasScheme()) {
      $url .= $this->getScheme() . ':';
    }
    if ($this->hasHost()) {
      $url .= '//';
      if ($this->hasUser()) {
        $url .= $this->getUser();
        if ($this->hasPassword()) {
          $url .= ':' . $this->getPassword();
        }
        $url .= '@';
      }
      $host = $this->getHost();
      if (preg_match('!^[\da-f]*:[\da-f.:]+$!ui', $host)) {
        $url .= '[' . $host . ']'; // IPv6
      } else {
        $url .= $host; // IPv4 or name
      }
      $port = $this->getPort();
      if ($port >= 0 && !$this->hasDefaultPort()) {
        $url .= ':' . $port;
      }
    }
    $url .= $this->getPath();
    if ($this->hasQuery()) {
      $url .= '?' . $this->getQuery()->getRaw();
//$url = trim($url, '=');
    }
    if ($this->hasFragment()) {
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
      $port = -1;
    }
    return ["scheme" => $this->parts['scheme'],
        'host' => $this->parts['host'],
        'port' => $port,
        'user' => $this->parts['user'],
        'pass' => $this->parts['pass'],
        'path' => $this->parts['path'],
        'query' => $this->getQuery()->toArray(),
        'fragment' => $this->parts['fragment'],
    ];
  }

  public function offsetExists($offset): bool {
    if (!array_key_exists($offset, static::$map)) {
      return false;
    }
    $part = static::$map[$offset];
    if ($part === 'query') {
      return !$this->getQuery()->isEmpty();
    }
    //$offset = $this->parsePartName($offset);
    return $this->parts[$part] !== null;
  }

  public function offsetGet($offset) {
    //$offset = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new InvalidArgumentException;
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
