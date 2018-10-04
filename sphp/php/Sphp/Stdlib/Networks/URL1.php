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

/**
 * Description of URL1
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class URL1 implements Arrayable, IteratorAggregate, \JsonSerializable, \ArrayAccess {

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
    $this->parseURL("$url");
  }

  protected function parseURL(string $url) {
    $this->parts = array_merge($this->parts, parse_url($url));
    if ($this->parts['port'] === null) {
      $port = getservbyname($this->getScheme(), 'tcp');
      if ($port === false) {
        $port = null;
      }
      $this->parts['port'] = $port;
    }
    $this->setQuery($this->parts['query']);
  }

  public function __call(string $name, $arguments) {
    $part = lcfirst(str_replace(['get', 'set', 'has'], '', $name));
    echo "Parsed part: '$part'";
    if ($this->offsetExists($part)) {
      echo "part '$part' exists: " . PHP_EOL;
      if (Strings::startsWith($name, 'get')) {
        echo "getting: $part" . PHP_EOL;
        return $this[$part];
      }
      if (Strings::startsWith($name, 'set')) {
        echo "setting: $part" . PHP_EOL;
        if (empty($arguments)) {
          $arguments[0] = null;
        }
        $this[$part] = $arguments[0];
        return $this;
      }
      if (Strings::startsWith($name, 'has')) {
        echo "Checking for: $part" . PHP_EOL;
        return $this->offsetExists($part);
      }
    } else {
      throw new \Sphp\Exceptions\BadMethodCallException("Method '$name' does not exists");
    }
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
   * Checks whether the `path` part of the URL is set or not
   * 
   * @return boolean true if the path is set and false otherwise
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
    $this->port = $port;
    return $this;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return int the port number; (`-1` if the port number can not be resolved)
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function getPort(): int {
    return (int) $this->parts['port'];
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return boolean true if the port number is the default for the scheme
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function hasDefaultPort(): bool {
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
    if (!($url instanceof URL1)) {
      $url = new URL1($url);
    }
    return $this == $url;
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
  public function getHtml(): string {
    $url = '';
    $encode = true;
    if ($this->hasScheme()) {
      $url .= $this->getScheme($encode) . ':';
    }
    if ($this->hasHost()) {
      $url .= '//';
      if ($this->hasUser()) {
        $url .= $this->getUser($encode);
        if ($this->hasPassword()) {
          $url .= ':' . $this->getPassword($encode);
        }
        $url .= '@';
      }
      $host = $this->getHost($encode);
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
    $url .= $this->getPath($encode);
    if ($this->hasQuery()) {
      $url .= '?' . $this->getQuery()->getHtml();
    }
    if ($this->hasFragment()) {
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
      $url .= '?' . $this->query->getRaw();
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
    return $this->parts;
  }

  private function parsePartName($offset) {
    if ($offset === 'username') {
      $offset = 'user';
    }
    if ($offset === 'password') {
      $offset = 'pass';
    }
    return $offset;
  }

  public function offsetExists($offset): bool {
    $offset = $this->parsePartName($offset);
    return array_key_exists($offset, $this->parts) && $this->parts[$offset] !== null;
  }

  public function offsetGet($offset) {
    $offset = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new \Sphp\Exceptions\InvalidArgumentException;
    }
    return (string) $this->parts[$offset];
  }

  public function offsetSet($offset, $value) {
    $offset = $this->parsePartName($offset);
    if (!array_key_exists($offset, $this->parts)) {
      throw new \Sphp\Exceptions\InvalidArgumentException;
    }
    return $this->parts[$offset] = $value;
  }

  public function offsetUnset($offset) {
    $offset = $this->parsePartName($offset);
    if ($this->offsetExists($offset)) {
      $this->parts[$offset] = null;
    }
  }

}
