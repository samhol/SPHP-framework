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
  private $container = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->container = [];
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

  public function contains(Script $script): bool {
    return in_array($script, $this->container, true);
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

}
