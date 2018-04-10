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

/**
 * Implements an URL for manipulation and comparison
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class URL implements Arrayable, IteratorAggregate, \JsonSerializable {

  /**
   * the current URL object
   *
   * @var URL 
   */
  private static $currUrl;

  /**
   * @var string|null 
   */
  private $scheme;

  /**
   * @var string|null 
   */
  private $host;

  /**
   * @var string|null 
   */
  private $user;

  /**
   * @var string|null 
   */
  private $pass;

  /**
   * @var string|null 
   */
  private $path;

  /**
   * @var QueryString
   */
  private $query;

  /**
   * @var string|null 
   */
  private $fragment;

  /**
   * @var int
   */
  private $port;

  /**
   * Constructs a new instance
   *
   * @param string|null $url the URL string
   */
  public function __construct(string $url = null) {
    $this->parseURL("$url");
  }

  protected function parseURL(string $url) {
    $this->setScheme(parse_url($url, PHP_URL_SCHEME));
    $this->setUser(parse_url($url, PHP_URL_USER));
    $this->setPassword(parse_url($url, PHP_URL_PASS));
    $this->setHost(parse_url($url, PHP_URL_HOST));
    $port = parse_url($url, PHP_URL_PORT);
    if ($port === null) {
      $port = getservbyname($this->getScheme(), 'tcp');
      if ($port === false) {
        $port = -1;
      }
    }
    $this->setPort($port);
    $this->setPath(parse_url($url, PHP_URL_PATH));
    $this->setQuery(parse_url($url, PHP_URL_QUERY));
    $this->setFragment(parse_url($url, PHP_URL_FRAGMENT));
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
    $this->scheme = $scheme;
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
    return (string) $this->scheme;
  }

  /**
   * Checks whether the `scheme` part of the URL is set or not
   * 
   * @return boolean true if the scheme is set and false otherwise
   */
  public function hasScheme(): bool {
    return $this->scheme !== null;
  }

  /**
   * Sets the `host` part of the URL
   * 
   * @param  string $host the `host` part of the URL
   * @return $this for a fluent interface
   */
  public function setHost(string $host = null) {
    $this->host = $host;
    return $this;
  }

  /**
   * Returns the `host` part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the host `part` of the URL
   */
  public function getHost(bool $encode = false): string {
    $val = $this->host;
    if ($encode && $val !== null && !Strings::match($val, '!^(\[[\da-f.:]+\]])|([\da-f.:]+)$!ui')) {
      $val = Strings::htmlEncode($val);
    }
    return $val;
  }

  /**
   * Checks whether the `host` part of the URL is set or not
   * 
   * @return boolean true if the host is set and false otherwise
   */
  public function hasHost(): bool {
    return $this->host !== null;
  }

  /**
   * Sets the username part of the URL
   * 
   * @param  string|null $user
   * @return $this for a fluent interface
   */
  public function setUser(string $user = null) {
    $this->user = $user;
    return $this;
  }

  /**
   * Returns the user part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the user part of the URL
   */
  public function getUser(bool $encode = false): string {
    if ($encode && $this->user !== null) {
      return rawurlencode($this->user);
    }
    return (string) $this->user;
  }

  /**
   * Checks whether the `user` part of the URL is set or not
   * 
   * @return boolean true if the user is set and false otherwise
   */
  public function hasUser(): bool {
    return $this->user !== null;
  }

  /**
   * Sets the password part of the URL
   * 
   * @param  string|null $pass
   * @return $this for a fluent interface
   */
  public function setPassword(string $pass = null) {
    $this->pass = $pass;
    return $this;
  }

  /**
   * Returns the password part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the password part of the URL
   */
  public function getPassword(bool $encode = false): string {
    if ($encode && $this->pass !== null) {
      return rawurlencode($this->pass);
    }
    return (string) $this->pass;
  }

  /**
   * Checks whether the `password` part of the URL is set or not
   * 
   * @return boolean true if the password is set and false otherwise
   */
  public function hasPassword(): bool {
    return $this->pass !== null;
  }

  /**
   * Sets the path part of the URL
   * 
   * @param  string|null $path the path part of the URL or null for none
   * @return $this for a fluent interface
   */
  public function setPath(string $path = null) {
    $this->path = $path;
    return $this;
  }

  /**
   * Returns the path part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the path part of the URL
   */
  public function getPath(bool $encode = false): string {
    if ($encode && $this->path !== null) {
      return preg_replace('!%2F!ui', '/', rawurlencode($this->path));
    }
    return (string) $this->path;
  }

  /**
   * Checks whether the `path` part of the URL is set or not
   * 
   * @return boolean true if the path is set and false otherwise
   */
  public function hasPath(): bool {
    return $this->path !== null;
  }

  /**
   * Sets the query part of the URL
   * 
   * @param  string $query the new query string
   * @return $this for a fluent interface
   */
  public function setQuery($query = null) {
    if (is_string($query)) {
      $this->query = new QueryString($query);
    } else if ($query instanceof QueryString) {
      $this->query = $query;
    } else {
      $this->query = new QueryString();
    }
    return $this;
  }

  /**
   * Checks whether the `path` part of the URL is set or not
   * 
   * @return boolean true if the path is set and false otherwise
   */
  public function hasQuery(): bool {
    return !$this->query->isEmpty();
  }

  /**
   * Returns the query string object of the URL
   * 
   * @return QueryString the query object
   */
  public function getQuery(): QueryString {
    return $this->query;
  }

  /**
   * Sets the fragment identifier of the URL
   * 
   * The fragment specifies a part or a position within the overall resource or document.
   * 
   * @param  string|null $fragment the fragment identifier of the URL
   * @return $this for a fluent interface
   */
  public function setFragment(string $fragment = null) {
    $this->fragment = $fragment;
    return $this;
  }

  /**
   * Returns the fragment identifier of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the fragment identifier of the URL
   */
  public function getFragment(bool $encode = false) {
    $val = strval($this->fragment);
    if ($encode) {
      $val = rawurlencode($val);
    }
    return $val;
  }

  /**
   * Checks whether the `fragment` part of the URL is set or not
   * 
   * @return boolean true if the fragment part is set and false otherwise
   */
  public function hasFragment(): bool {
    return $this->fragment !== null;
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
    return (int) $this->port;
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
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
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
    if ($this->hasPath()) {
      $url .= $this->getPath($encode);
    }
    if ($this->hasQuery()) {
      $url .= '?' . $this->query->getQuery('&amp;', \PHP_QUERY_RFC3986);
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
    if ($this->hasPath()) {
      $url .= $this->getPath();
    }
    if ($this->hasQuery()) {
      $url .= '?' . $this->query->getQuery('&', \PHP_QUERY_RFC3986);
      $url = trim($url, '=');
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
   */
  public function isCurrent(): bool {
    return $this->equals(URL::getCurrent());
  }

  public function jsonSerialize() {
    return get_object_vars($this);
  }

  /**
   * Returns the current URL as an object
   *
   * @return string the current URL
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
   */
  public static function getCurrent(): URL {
    if (self::$currUrl === null) {
      $url = new static(static::getCurrentURL());

      self::$currUrl = $url;
    }
    return clone self::$currUrl;
  }

  public function toArray(): array {
    return ["scheme" => $this->scheme,
        'host' => $this->host,
        'port' => $this->port,
        'user' => $this->user,
        'pass' => $this->pass,
        'path' => $this->path,
        'query' => $this->query->toArray(),
        'fragment' => $this->fragment,
    ];
  }

}
