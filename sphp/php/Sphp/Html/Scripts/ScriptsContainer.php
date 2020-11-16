<?php

declare(strict_types=1);

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
use Sphp\Html\ContentIterator;
use Traversable;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Datastructures\PriorityList;

/**
 * Implements a JavaScript component container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ScriptsContainer extends AbstractContent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * scripts container
   *
   * @var PriorityList
   */
  private $scripts;

  /**
   * Constructor
   */
  public function __construct() {
    $this->scripts = new PriorityList(false);
  }

  public function __destruct() {
    unset($this->scripts);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->scripts = clone $this->scripts;
  }

  /**
   * Appends a script component to the container
   * 
   * @param  Script $script
   * @param  int $priority
   * @return $this for a fluent interface
   */
  public function insert(Script $script, int $priority = 0) {
    $name = $script->getHash();
    $this->scripts->insert($name, $script, $priority);
    return $this;
  }

  /**
   * Appends a script component pointing to the given `src`
   * 
   * @param  string $src the file path of the script file 
   * @param  int $priority
   * @return ExternalScript appended code component
   * @link   http://www.w3schools.com/tags/att_script_src.asp src attribute
   */
  public function insertExternal(string $src, int $priority = 0): ExternalScript {
    $script = new ExternalScript($src);
    $this->insert($script, $priority);
    return $script;
  }

  /**
   * Appends a script component containing script commands
   * 
   * @param  string $code script commands
   * @param  int $priority
   * @return InlineScript appended code component
   */
  public function insertInline(string $code, int $priority = 0): InlineScript {
    $script = new InlineScript($code);
    $this->insert($script, $priority);
    return $script;
  }

  public function setExternalsAsync(bool $async = true) {
    foreach ($this->getExternalScripts() as $script) {
      $script->setAsync($async);
    }
    return $this;
  }

  public function setExternalsDefer(bool $defer = true) {
    foreach ($this->getExternalScripts() as $script) {
      $script->setDefer($defer);
    }
    return $this;
  }

  public function contains(Script $script): bool {
    return $this->scripts->contains($script->getHash());
  }

  public function containsExternal(string $src): bool {
    $hash = (new ExternalScript($src))->getHash();
    return $this->scripts->contains($hash);
  }

  public function getExternalScripts(): TraversableContent {
    return $this->getComponentsByObjectType(ExternalScript::class);
  }

  public function getInlineScripts(): TraversableContent {
    return $this->getComponentsByObjectType(InlineScript::class);
  }

  public function getHtml(): string {
    $out = '';
    foreach ($this->scripts as $script) {
      $out .= $script;
    }
    return $out;
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->scripts->toArray());
  }

}
