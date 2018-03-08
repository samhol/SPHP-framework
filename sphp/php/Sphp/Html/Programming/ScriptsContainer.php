<?php

/**
 * ScriptsContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Iterator;
use Traversable;

/**
 * Implements a JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptsContainer implements Script, IteratorAggregate, TraversableContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * scripts container
   *
   * @var Script[] 
   */
  private $container = [];

  /**
   * Constructs a new instance
   * 
   * @param Script|Script[] $scripts script components
   */
  public function __construct($scripts = null) {
    $this->container = [];
    if ($scripts !== null) {
      foreach (is_array($scripts) ? $scripts : [$scripts] as $script) {
        $this->append($script);
      }
    }
  }

  /**
   * Appends a script component to the container
   * 
   * @param  Script $script
   * @return $this for a fluent interface
   */
  public function append(Script $script) {
    $this->container[] = $script;
    return $this;
  }

  /**
   * Appends a script component pointing to the given `src`
   * 
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return ScriptSrc appended code component
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendSrc(string $src, bool $async = false): ScriptSrc {
    $script = new ScriptSrc($src, $async);
    $this->append($script);
    return $script;
  }

  /**
   * Appends a script component containing script commands
   * 
   * @param  string $code script commands
   * @return ScriptCode appended code component
   */
  public function appendCode($code): ScriptCode {
    $script = new ScriptCode($code);
    $this->append($script);
    return $script;
  }

  public function getHtml(): string {
    return implode($this->container);
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->container);
  }

  /**
   * Count the number of inserted script components
   *
   * @return int the number of inserted script components
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->container);
  }

}
