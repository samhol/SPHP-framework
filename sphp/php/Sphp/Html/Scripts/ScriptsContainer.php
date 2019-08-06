<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use Sphp\Html\AbstractContent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Iterator;
use Traversable;
use Sphp\Stdlib\Arrays;

/**
 * Implements a JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScriptsContainer extends AbstractContent implements Script, IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * scripts container
   *
   * @var Script[] 
   */
  private $script;

  /**
   * Constructor
   */
  public function __construct() {
    $this->script = [];
  }

  public function __destruct() {
    unset($this->script);
  }

  public function __clone() {
    $this->script = Arrays::copy($this->script);
  }

  /**
   * Appends a script component to the container
   * 
   * @param  Script $script
   * @return $this for a fluent interface
   */
  public function append(Script $script) {
    $this->script[] = $script;
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

  public function setAsync(bool $async = true) {
    foreach ($this->script as $script) {
      $script->setAsync($async);
    }
    return $this;
  }

  public function isAsync(): bool {
    $isAsync = true;
    foreach ($this->script as $script) {
      if (!$script->isAsync()) {
        $isAsync = false;
        break;
      }
    }
    return $isAsync;
  }

  public function setDefer(bool $defer = true) {
    foreach ($this->script as $script) {
      $script->setDefer($defer);
    }
    return $this;
  }
  public function isDefered(): bool {
    $isAsync = true;
    foreach ($this->script as $script) {
      if (!$script->isDefered()) {
        $isAsync = false;
        break;
      }
    }
    return $isAsync;
  }

  public function contains(Script $script): bool {
    return in_array($script, $this->script, true);
  }

  public function getHtml(): string {
    return implode($this->script);
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->script);
  }

}
