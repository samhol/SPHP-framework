<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

/**
 * Implements an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component contains scripting statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScriptCode extends AbstractScriptTag implements \ArrayAccess, \IteratorAggregate {

  private $code = [];

  /**
   * Constructor
   * 
   * **IMPORTANT:** 
   * 
   * This component contains scripting statements
   *
   * @param string $code the script code inside the script component or `null` for empty
   */
  public function __construct(string $code = null) {
    parent::__construct();
    $this->code = [];
    if ($code !== null) {
      $this->code[] = $code;
    }
  }

  public function contentToString(): string {
    return implode($this->code);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->code);
  }

  public function append(string $code) {
    array_push($this->code, $code);
    return $this;
  }

  /**
   * Checks whether an offset exists
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return isset($this->code[$offset]) || array_key_exists($offset, $this->code);
  }

  /**
   * Returns the content element at the specified offset
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content element or null
   */
  public function offsetGet($offset) {
    $result = null;
    if ($this->offsetExists($offset)) {
      $result = $this->code[$offset];
    }
    return $result;
  }

  /**
   * Assigns content to the specified offset
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value): void {
    $this->code[$offset] = $value;
  }

  /**
   * Unsets an offset
   *
   * @param  mixed $offset offset to unset
   * @return void
   */
  public function offsetUnset($offset): void {
    if ($this->offsetExists($offset)) {
      unset($this->code[$offset]);
    }
  }

}
