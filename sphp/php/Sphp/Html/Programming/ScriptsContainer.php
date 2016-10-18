<?php

/**
 * ScriptsContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContentInterface;
use Sphp\Html\ContentTrait;
use Sphp\Html\TraversableInterface;
use Sphp\Html\TraversableTrait;
use Sphp\Html\Container;

/**
 * Class implements a JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-27
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScriptsContainer implements ContentInterface, TraversableInterface {

  use ContentTrait,
      TraversableTrait;

  /**
   * scripts container
   *
   * @var Container 
   */
  private $container;

  /**
   * Constructs a new instance
   * 
   * @param ScriptInterface|ScriptInterface[] $scripts script components
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
   * appends a {@link ScriptInterface} component to the container
   * 
   * @param  ScriptInterface $script
   * @return self for PHP Method Chaining
   */
  public function append(ScriptInterface $script) {
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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_script_async.asp async attribute
   */
  public function appendSrc($src, $async = false) {
    $this->append(new ScriptSrc($src, $async));
    return $this;
  }

  /**
   * Appends an {@link ScriptCode} containing script commands
   * 
   * @param  string $code script commands
   * @return self for PHP Method Chaining
   */
  public function appendCode($code) {
    $this->append(new ScriptCode($code));
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->container->getHtml();
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->container->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    $this->container->count();
  }

}
