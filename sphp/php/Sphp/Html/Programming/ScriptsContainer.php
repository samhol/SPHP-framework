<?php

/**
 * ScriptsContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use IteratorAggregate;
use Sphp\Html\ContentInterface;
use Sphp\Html\TraversableInterface;
use Sphp\Html\Container;

/**
 * Implements a JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptsContainer implements IteratorAggregate, ContentInterface, TraversableInterface {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * scripts container
   *
   * @var Container 
   */
  private $container;

  /**
   * Constructs a new instance
   * 
   * @param Script|Script[] $scripts script components
   */
  public function __construct($scripts = null) {
    $this->container = new Container();
    if ($scripts !== null) {
      foreach (is_array($scripts) ? $scripts : [$scripts] as $script) {
        $this->append($script);
      }
    }
  }

  /**
   * appends a script component to the container
   * 
   * @param  Script $script
   * @return $this for a fluent interface
   */
  public function append(Script $script) {
    if ($script instanceof ScriptSrc) {
      $this->container->offsetSet($script->getSrc(), $script);
    } else {
      $this->container->append($script);
    }
    return $this;
  }

  /**
   * Appends an {@link ScriptSrc} pointing to the given `src`
   * 
   * @param  string $src the file path of the script file
   * @param  boolean $async true for asynchronous execution, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendSrc(string $src, bool $async = false) {
    $this->append(new ScriptSrc($src, $async));
    return $this;
  }

  /**
   * Appends an {@link ScriptCode} containing script commands
   * 
   * @param  string $code script commands
   * @return $this for a fluent interface
   */
  public function appendCode($code) {
    $this->append(new ScriptCode($code));
    return $this;
  }
  
  public function getHtml(): string {
    return $this->container->getHtml();
  }

  public function getIterator() {
    return $this->container->getIterator();
  }

  public function count(): int {
    $this->container->count();
  }

}
