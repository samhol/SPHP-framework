<?php

/**
 * URL.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

use Sphp\Data\Arrayable;
use IteratorAggregate;

/**
 * Implements an URL for manipulation and comparison
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class URL implements Arrayable, IteratorAggregate {

  /**
   * the current url object
   *
   * @var string 
   */
  private static $currUrl;

  /**
   * an array containing all the URL parts
   *
   * @var string[]
   */
  private $components = [
      'scheme' => '',
      'host' => '',
      'user' => '',
      'pass' => '',
      'path' => '',
      'query' => [],
      'fragment' => '',
      'port' => ''
  ];

  /**
   * Constructs a new instance
   *
   * @param string|null $url the URL string
   */
  public function __construct($url = null) {
    if ($url !== null) {
      $arr = [
          'scheme' => '',
          'host' => '',
          'user' => '',
          'pass' => '',
          'path' => '',
          'query' => '',
          'fragment' => '',
          'port' => ''
      ];
      $urlString = html_entity_decode(urldecode($url));
      $parts = array_merge($arr, parse_url($urlString));
      $query = [];
      parse_str($parts['query'], $query);
      $this->components = $parts; //array_merge($this->components, parse_url($urlString));
      $this->components['query'] = $query;
      $this->parsePort($this->components['port']);
    }
  }

  /**
   * 
   * @param scalar $candidate
   */
  private function parsePort($candidate) {
    if (!is_int($candidate)) {
      $candidate = (int) $candidate;
    }
    if ($candidate <= 0) {
      $candidate = getservbyname($this->getScheme(), 'tcp');
      if ($candidate === false) {
        $candidate = -1;
      }
    }
    $this->setPort($candidate);
    return $this;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->components);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->components = Arrays::copy($this->components);
  }

  /**
   * 
   * @return array
   */
  public function __debugInfo() {
    return $this->components;
  }

  /**
   * Sets the scheme name (service name) of the URL
   * 
   * * **All schemes are transformed to lowercase.**
   * * The scheme is ususally the name of a protocol, defines how the resource will be obtained.
   * * Supported service names: `http`, `https`, `ftp`, `ssh`, `telnet`, `imap`, `smtp`, `nicname`, `gopher`, `finger`, `pop3` and `www`
   *  
   * 
   * @param  string|null $scheme the scheme name of the URL
   * @return self for PHP Method Chaining
   */
  public function setScheme($scheme = null) {
    $this->components['scheme'] = (string) $scheme;
    return $this;
  }

  /**
   * Returns the scheme name of the URL
   * 
   * The scheme is ususally the name of a protocol, defines how the resource 
   * will be obtained. Examples include `http`, `https`, `ftp`, `file` and many 
   * others. **All schemes are transformed to lowercase.**
   * 
   * @return string the scheme name of the URL
   */
  public function getScheme() {
    return $this->components['scheme'];
  }

  /**
   * Checks whether the `scheme` part of the URL is set or not
   * 
   * @return boolean true if the scheme is set and false otherwise
   */
  public function hasScheme() {
    return $this->components['scheme'] !== '';
  }

  /**
   * Sets the `host` part of the URL
   * 
   * @param  string $host the `host` part of the URL
   * @return self for PHP Method Chaining
   */
  public function setHost($host = null) {
    $this->components['host'] = (string) $host;
    return $this;
  }

  /**
   * Returns the `host` part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the host `part` of the URL
   */
  public function getHost($encode = false) {
    $val = $this->components['host'];
    if ($encode && !Strings::isEmpty($val) && !Strings::match($val, '!^(\[[\da-f.:]+\]])|([\da-f.:]+)$!ui')) {
      Strings::htmlEncode($val);
    }
    return $val;
  }

  /**
   * Checks whether the `host` part of the URL is set or not
   * 
   * @return boolean true if the host is set and false otherwise
   */
  public function hasHost() {
    return $this->components['host'] !== '';
  }

  /**
   * Sets the username part of the URL
   * 
   * @param  string|null $user
   * @return self for PHP Method Chaining
   */
  public function setUser($user = null) {
    $this->components['user'] = (string) $user;
    return $this;
  }

  /**
   * Returns the user part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the user part of the URL
   */
  public function getUser($encode = false) {
    $val = strval($this->components['user']);
    if ($encode && !Strings::isEmpty($val)) {
      $val = rawurlencode($val);
    }
    return $val;
  }

  /**
   * Checks whether the `user` part of the URL is set or not
   * 
   * @return boolean true if the user is set and false otherwise
   */
  public function hasUser() {
    return $this->components['user'] !== '';
  }

  /**
   * Sets the password part of the URL
   * 
   * @param  string|null $pass
   * @return self for PHP Method Chaining
   */
  public function setPassword($pass = null) {
    $this->components['pass'] = (string) $pass;
    return $this;
  }

  /**
   * Returns the password part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the password part of the URL
   */
  public function getPassword($encode = false) {
    $val = $this->components['pass'];
    if ($encode && $val !== '') {
      $val = rawurlencode($val);
    }
    return $val;
  }

  /**
   * Checks whether the `password` part of the URL is set or not
   * 
   * @return boolean true if the password is set and false otherwise
   */
  public function hasPassword() {
    return $this->components['pass'] !== '';
  }

  /**
   * Sets the path part of the URL
   * 
   * @param  string|null $path the path part of the URL or null for none
   * @return self for PHP Method Chaining
   */
  public function setPath($path = null) {
    if ($path === null || $path === '') {
      $path = '';
    } else if (!Strings::startsWith($path, '/')) {
      $path = "/$path";
    }
    $this->components['path'] = $path;
    return $this;
  }

  /**
   * Returns the path part of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the path part of the URL
   */
  public function getPath($encode = false) {
    $val = $this->components['path'];
    if ($encode && !Strings::isEmpty($val)) {
      $val = preg_replace('!%2F!ui', '/', rawurlencode($val));
    }
    return $val;
  }

  /**
   * Checks whether the `path` part of the URL is set or not
   * 
   * @return boolean true if the path is set and false otherwise
   */
  public function hasPath() {
    return $this->components['path'] !== '';
  }

  /**
   * Sets the query part of the URL
   * 
   * @param  string $query the new query string
   * @return self for PHP Method Chaining
   */
  public function setQuery($query) {
    if ($query !== '') {
      parse_str($query, $this->components['query']);
    } else {
      $this->components['query'] = [];
    }
    return $this;
  }

  /**
   * Checks whether the `path` part of the URL is set or not
   * 
   * @return boolean true if the path is set and false otherwise
   */
  public function hasQuery() {
    return !empty($this->components['query']);
  }

  /**
   * Returns the query string part of the URL
   * 
   * The query string contains data to be passed to software running on the 
   * server. It may contain name/value pairs separated by ampersands.
   * 
   * @param  string $separator
   * @param  int $encode
   * @return string the query string of the URL
   */
  public function getQuery($separator = '&', $encode = \PHP_QUERY_RFC1738) {
    $val = '';
    if ($this->hasQuery()) {
      $val = http_build_query($this->components['query'], '', $separator, $encode);
    }
    return $val;
  }

  /**
   * Checks whether a param exists in the query
   * 
   * @param  string $name the name of the param
   * @return boolean true if the param exists and false otherwise
   */
  public function paramExists($name) {
    return array_key_exists($name, $this->components['query']);
  }

  /**
   * Return the query as an array of params
   *
   * @return string[] the param array
   */
  public function getParams() {
    return $this->components['query'];
  }

  /**
   * Return the value of the param
   *
   * @param  string $name the name of the param
   * @return string|null the value of the param or null if the param does not exist
   */
  public function getParam($name) {
    $val = null;
    if ($this->paramExists($name)) {
      $val = $this->components['query'][$name];
    }
    return $val;
  }

  /**
   * Sets or replaces a param in the query
   *
   * @param  string $name the name of the param
   * @param  string $value the value of the param
   * @return self for PHP Method Chaining
   */
  public function setParam($name, $value) {
    $this->components['query'][$name] = $value;
    return $this;
  }

  /**
   * Sets or replaces params in the query
   *
   * @param  string[] $params parameter name => value pairs or a query string
   * @return self for PHP Method Chaining
   */
  public function setParams(array $params) {
    $this->components['query'] = array_merge($this->components['query'], $params);
    //$this->setQuery(urldecode(http_build_query($this->components["query"])));
    return $this;
  }

  /**
   * Removes a parameter from the query
   *
   * @param  string $name the name of the parameter to remove
   * @return self for PHP Method Chaining
   */
  public function unsetParam($name) {
    if (array_key_exists($name, $this->components['query'])) {
      unset($this->components['query'][$name]);
    }
    return $this;
  }

  /**
   * Sets the fragment identifier of the URL
   * 
   * The fragment specifies a part or a position within the overall resource or document.
   * 
   * @param  string|null $fragment the fragment identifier of the URL
   * @return self for PHP Method Chaining
   */
  public function setFragment($fragment) {
    $this->components['fragment'] = $fragment;
    return $this;
  }

  /**
   * Returns the fragment identifier of the URL
   * 
   * @param  boolean $encode true if the value should be encoded
   * @return string the fragment identifier of the URL
   */
  public function getFragment($encode = false) {
    $val = strval($this->components['fragment']);
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
  public function hasFragment() {
    return $this->components['fragment'] !== '';
  }

  /**
   * Sets the port number of the URL
   * 
   * @precondition $port >= 0
   * @param  int $port
   * @return self for PHP Method Chaining
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function setPort($port) {
    $this->components['port'] = (int) $port;
    return $this;
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return int the port number; (`-1` if the port number can not be resolved)
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function getPort() {
    return $this->components['port'];
  }

  /**
   * Returns the port number associated with this service and a given protocol
   *
   * @return boolean true if the port number is the default for the scheme
   * @link   http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml
   */
  public function hasDefaultPort() {
    return getservbyname($this->getScheme(), 'tcp') === $this->getPort();
  }

  /**
   * Create a new iterator to iterate through the URL components
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return new \ArrayIterator($this->components);
  }

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  string|URL $url the URL to compare with the current URL
   * @return boolean true if the specified URL is equal to the current URL, otherwise false
   */
  public function equals($url) {
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
  public function __toString() {
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
  public function getHtml() {
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
      $url .= '?' . $this->getQuery('&amp;', \PHP_QUERY_RFC3986);
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
  public function getRaw() {
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
      $url .= '?' . $this->getQuery('&', \PHP_QUERY_RFC3986);
      $url = trim($url, '=');
    }
    if ($this->hasFragment()) {
      $url .= '#' . $this->getFragment();
    }
    return $url;
  }

  /**
   * Returns the Mime type of the content
   *
   * @return string|boolean the Mime type of the content or false if the Mime 
   *         type cannot be resolved
   */
  public function getMimeType() {
    $url = $this->__toString();
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_exec($ch);
    return curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  }

  /**
   * Checks whether the URL exists or not
   *
   * @return boolean true if the url exists and false otherwise
   */
  public function exists() {
    if (!$this->hasHost()) {
      return false;
    }
    $errno = '';
    $errstr = '';
    $fp = fsockopen($this->getHost(), 80, $errno, $errstr, 30);
    if ($fp === false) {
      return false;
    }
    $path = '';
    if ($this->hasPath()) {
      $path .= $this->getPath();
    }
    if ($this->hasQuery()) {
      $path .= '?' . $this->getQuery('&', \PHP_QUERY_RFC3986);
    }
    $out = "GET /$path HTTP/1.1\r\n";
    $out .= "Host: {$this->getHost()}\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    $content = fgets($fp);
    $code = trim(substr($content, 9, 4));
    fclose($fp);
    return ($code[0] == 2 || $code[0] == 3) ? true : false;
  }

  /**
   * Checks whether the URL is current browser URL or not 
   * 
   * @return boolen true if the URL is current browser URL, false otherwise
   */
  public function isCurrent() {
    return $this->equals(URL::getCurrent());
  }

  /**
   * Returns the current URL as an object
   *
   * @return URL the current url
   */
  public static function getCurrent() {
    if (self::$currUrl === null) {
      $url = new URL();
      if (!empty($_SERVER["HTTPS"])) {
        $url->setScheme("https");
      } else {
        $url->setScheme("http");
      }
      $url->setHost(filter_input(INPUT_SERVER, "SERVER_NAME", FILTER_SANITIZE_STRING));
      $url->setPort(filter_input(INPUT_SERVER, "SERVER_PORT", FILTER_SANITIZE_NUMBER_INT));
      $php_self = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_URL);
      $request_uri = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);
      if (Strings::startsWith($request_uri, $php_self)) {
        $url->setPath($php_self);
        $url->setQuery(filter_input(INPUT_SERVER, "QUERY_STRING", FILTER_SANITIZE_URL));
      } else {
        $url->setPath(parse_url($request_uri, PHP_URL_PATH));
        $url->setQuery(parse_url($request_uri, PHP_URL_QUERY));
      }
      self::$currUrl = $url;
    }
    return clone self::$currUrl;
  }

  public function toArray() {
    return $this->getIterator()->getArrayCopy();
  }

}
