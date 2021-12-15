<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network;

use Sphp\Stdlib\Datastructures\Arrayable;
use IteratorAggregate;
use Traversable;
use Sphp\Stdlib\Strings;

/**
 * Implements an URL object for manipulation and comparison
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class URL implements Arrayable, IteratorAggregate, \JsonSerializable {

  private ?string $scheme = null;
  private ?string $host = null;
  private ?int $port = null;
  private ?string $user = null;
  private ?string $pass = null;
  private ?string $path = null;
  private QueryString $query;
  private ?string $fragment = null;

  /**
   * the current URL object
   *
   * @var URL 
   */
  private static ?URL $currUrl = null;

  /**
   * Constructor
   *
   * @param string|null $url the URL string
   */
  public function __construct(?string $url = null) {
    if ($url !== null) {
      $this->scheme = parse_url($url, PHP_URL_SCHEME);
      $this->host = parse_url($url, PHP_URL_HOST);
      $this->port = parse_url($url, PHP_URL_PORT);
      $this->user = parse_url($url, PHP_URL_USER);
      $this->pass = parse_url($url, PHP_URL_PASS);
      $this->path = parse_url($url, PHP_URL_PATH);
      $this->setQuery(parse_url($url, PHP_URL_QUERY));
      $this->fragment = parse_url($url, PHP_URL_FRAGMENT);
    } else {
      $this->setQuery(null);
    }
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->query = clone $this->query;
  }

  /**
   * Sets the userinfo component 
   * 
   * @param  string|null $username
   * @return $this for a fluent interface
   */
  public function setUsername(?string $username) {
    $this->user = $username;
    return $this;
  }

  /**
   * Sets the path component
   * 
   * @param  string|null $password
   * @return $this for a fluent interface
   */
  public function setPassword(?string $password) {
    $this->pass = $password;
    return $this;
  }

  /**
   * Sets the path component 
   * 
   * @param  string|null $path
   * @return $this for a fluent interface
   */
  public function setPath(?string $path) {
    $this->path = $path;
    return $this;
  }

  /**
   * Sets the fragment component 
   * 
   * @param  string|null $fragment
   * @return $this for a fluent interface
   */
  public function setFragment(?string $fragment) {
    $this->fragment = $fragment;
    return $this;
  }

  /**
   * Sets the scheme component 
   * 
   * @param  string|null $scheme the scheme component 
   * @return $this for a fluent interface
   */
  public function setScheme(?string $scheme) {
    $this->scheme = $scheme;
    return $this;
  }

  /**
   * Returns the scheme name of the URL
   * 
   * <b>URL:</b> <var><b>scheme</b>:[//authority]path[?query] [#fragment]</var>
   * 
   * The scheme is usually the name of a protocol, defines how the resource 
   * will be obtained. Examples include `http`, `https`, `ftp`, `file` and many 
   * others. **All schemes are transformed to lowercase.**
   * 
   * @return string|null the scheme name of the URL or null if the scheme is not set
   */
  public function getScheme(): ?string {
    return $this->scheme;
  }

  /**
   * Checks if the scheme component is set
   * 
   * @return bool true if the scheme component is set, false otherwise
   */
  public function containsScheme(): bool {
    return $this->scheme !== null;
  }

  /**
   * Sets the host component 
   * 
   * @param  string|null $host the host component 
   * @return $this for a fluent interface
   */
  public function setHost(?string $host) {
    $this->host = $host;
    return $this;
  }

  /**
   * Returns the host component
   * 
   * <b>URL:</b> <var>scheme:[//[userinfo@]<b>host</b>[:port]]path[?query][#fragment]</var>
   *  
   * @return string the host component
   */
  public function getHost(): ?string {
    $host = $this->host;
    return $host;
  }

  /**
   * Checks if the URL is IPv6
   * 
   * @return bool true if the host is IPv6, false otherwise
   */
  public function isIPv6(): bool {
    return $this->containsHost() &&
            Strings::match($this->host, '!^[\da-f]*:[\da-f.:]+$!ui');
  }

  /**
   * Checks if the host component is set
   * 
   * @return bool true if the host component is set, false otherwise
   */
  public function containsHost(): bool {
    return $this->host !== null;
  }

  /**
   * Returns the user component
   * 
   * <b>URL:</b> <var>scheme:[//[<b>userinfo</b>@]host[:port]]path[?query][#fragment]</var>
   *  
   * @return string the user component
   */
  public function getUser(): ?string {
    return $this->user;
  }

  /**
   * Checks if the user part of the URL is set
   * 
   * @return bool true if the user part is set, false otherwise
   */
  public function containsUser(): bool {
    return $this->user !== null;
  }

  /**
   * Returns the fragment component
   * 
   *  <var>scheme:[//authority]path[?query] [#<b>fragment</b>]</var>
   *  
   * @return string the fragment component
   */
  public function getPassword(): ?string {
    return $this->pass;
  }

  /**
   * Checks if the password component of the URL is set
   * 
   * @return bool true if the password component is set, false otherwise
   */
  public function containsPassword(): bool {
    return $this->pass !== null;
  }

  /**
   * Returns the path component of the URL
   * 
   * @return string the path part of the URL
   */
  public function getPath(): ?string {
    return $this->path;
  }

  /**
   * Checks if the path component of the URL is set
   * 
   * @return bool true if the path component is set, false otherwise
   */
  public function containsPath(): bool {
    return $this->path !== null;
  }

  /**
   * Sets the query component of the URL
   * 
   * @param  string|iterable|QueryString|null $query the new query string
   * @return $this for a fluent interface
   */
  public function setQuery($query) {
    if ($query instanceof QueryString) {
      $this->query = $query;
    } else {
      $this->query = new QueryString($query);
    }
    return $this;
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
   * Checks if the query part of the URL is set
   * 
   * @return bool true if the query part is set, false otherwise
   */
  public function containsQuery(): bool {
    return $this->query !== null && !$this->query->isEmpty();
  }

  /**
   * Sets the port subcomponent 
   * 
   * @param  int|null $port the port subcomponent (null for default port)
   * @return $this for a fluent interface
   */
  public function setPort(?int $port) {
    $this->port = $port;
    return $this;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml IANA
   * @return int|null the port number; (null if the port number can not be resolved) 
   */
  public function resolvePort(): ?int {
    $port = $this->port;
    if ($this->port === null && $this->scheme !== null) {
      $port = getservbyname($this->scheme, 'tcp');
      if ($port === false) {
        $port = null;
      }
    }
    return $port;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml IANA
   * @return int|null the port number; (null if the port number can not be resolved) 
   */
  public function getPort(): ?int {
    return $this->port;
  }

  /**
   * Returns the authority component
   * 
   *  <var>scheme:<b>[//authority]</b>path[?query] [#fragment]</var>
   * 
   *  The authority component divides into three subcomponents:
   *  <var><b>authority</b> = [userinfo@]host[:port]</var>
   * 
   * @return string the authority component
   */
  public function getAuthority(): string {
    $output = '//';
    if ($this->containsUser()) {
      $output .= $this->getUser();
      if ($this->containsPassword()) {
        $output .= ':' . $this->getPassword();
      }
      $output .= '@';
    }
    if ($this->isIPv6()) {
      $output .= '[' . $this->getHost() . ']';
    } else {
      $output .= $this->getHost();
    }
    if (!$this->hasDefaultPort()) {
      $output .= ':' . $this->getPort();
    }
    return $output;
  }

  /**
   * Checks if the port part of the URL is set
   * 
   * @return bool true if the port part is set, false otherwise
   */
  public function containsPort(): bool {
    return $this->port !== null;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return bool true if the port number is the default for the scheme
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function hasDefaultPort(): bool {
    $out = false;
    if ($this->port === null) {
      $out = true;
    } else if ($this->scheme !== null) {
      $out = getservbyname($this->scheme, 'tcp') === $this->port;
    }
    return $out;
  }

  /**
   * Returns the fragment component
   * 
   * <b>URL:</b> <var>scheme:[//authority]path[?query] [#<b>fragment</b>]</var>
   *  
   * @return string the fragment component
   */
  public function getFragment(): ?string {
    return $this->fragment;
  }

  /**
   * Checks if the fragment part of the URL is set
   * 
   * @return bool true if the fragment part is set, false otherwise
   */
  public function containsFragment(): bool {
    return $this->fragment !== null;
  }

  /**
   * Create a new iterator to iterate through the URL components
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $it = new \ArrayIterator($this->toArray());
    return $it;
  }

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  string|URL $url the URL to compare with the current URL
   * @return bool true if equals, otherwise false
   */
  public function equals($url): bool {
    if (!($url instanceof URL)) {
      $url = new URL($url);
    }
    $thisArray = $this->toArray();
    $thisArray['port'] = $this->resolvePort();
    $thisArray['query'] = $this->getQuery()->toArray();

    $otherArray = $url->toArray();
    $otherArray['port'] = $url->resolvePort();
    $otherArray['query'] = $url->getQuery()->toArray();
    return $thisArray == $otherArray;
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
    return $this->parseToString();
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * **String format:** 
   * [scheme]://[user]:[pass]@[host]:[port]/[path]?[query]#[fragment]
   *
   * @return string representation of the object
   */
  public function parseToString(int $queryEncoding = PHP_QUERY_RFC1738): string {
    $url = '';
    if ($this->containsScheme()) {
      $url .= $this->getScheme() . ':';
    }
    $url .= $this->getAuthority();
    $url .= $this->getPath();
    if ($this->containsQuery()) {
      $url .= '?' . $this->getQuery()->build($queryEncoding);
    }
    if ($this->containsFragment()) {
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
    return $this->toArray();
  }

  public function toJson(): string {
    return json_encode($this->toArray());
  }

  public function toArray(): array {
    $out = get_object_vars($this);
    if ($this->getQuery()->isEmpty()) {
      unset($out['query']);
    } else {
      $out['query'] = (string) $this->getQuery();
    }
    return array_filter($out, fn($x) => $x !== null);
  }

  /**
   * Returns the current URL as an object
   *
   * @return string the current URL
   * @codeCoverageIgnore
   */
  public static function getCurrentAsString(int $flags = 0): string {
    $port = filter_input(INPUT_SERVER, 'SERVER_PORT', FILTER_VALIDATE_INT);
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
   * 
   * @return string
   * @codeCoverageIgnore
   */
  public static function getRootAsString(): string {
    $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_SPECIAL_CHARS);
    $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $host . '/';
    return $root;
  }

  /**
   * Returns the current URL as an object
   *
   * @return URL the current URL as an object
   * @codeCoverageIgnore
   */
  public static function getCurrent(): URL {
    if (self::$currUrl === null) {
      $url = new static(static::getCurrentAsString());
      self::$currUrl = $url;
    }
    return clone self::$currUrl;
  }

}
