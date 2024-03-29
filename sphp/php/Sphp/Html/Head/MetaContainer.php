<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractContent;
use Sphp\Html\ContentIteratorAggregate;
use Countable;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Datastructures\PriorityList;
use Sphp\Html\Scripts\ExternalScript;

/**
 * Class MetaContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MetaContainer extends AbstractContent implements ContentIteratorAggregate, Countable {

  /**
   * @var PriorityList<MetaData>
   */
  private PriorityList $container;

  /**
   * Constructor
   */
  public function __construct() {
    $this->container = new PriorityList(false);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->container);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->container = clone $this->container;
  }

  /**
   * Sets a head content component
   * 
   * @param  iterable $metaCollection head content component
   * @param  int $priority
   * @return $this for a fluent interface
   */
  public function insertAll(iterable $metaCollection, int $priority = 0) {
    foreach ($metaCollection as $meta) {
      $this->insert($meta, $priority);
    }
    return $this;
  }

  /**
   * Sets a head content component
   * 
   * @param  MetaData $component head content component
   * @return $this for a fluent interface
   */
  public function insert(MetaData $component, int $priority = 0) {
    $name = $component->getHash();
    $this->container->insert($name, $component, $priority);
    return $this;
  }

  /**
   * Sets a head content component
   * 
   * @param  MetaData $component head content component
   * @return $this for a fluent interface
   */
  public function remove(MetaData $component) {
    $name = $component->getHash();
    $this->container->remove($name);
    return $this;
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  string $title
   * @param  int $priority
   * @return Title
   */
  public function setTitle(string $title, int $priority = 0): Title {
    $obj = new Title($title);
    $this->container->insert($obj->getHash(), $obj, $priority);
    return $obj;
  }

  /**
   * Sets the base address of the HTML page
   * 
   * @param  string $href
   * @param  string $target
   * @return Base
   */
  public function setBaseAddress(string $href, string $target = null, int $priority = 0): Base {
    $obj = new Base($href, $target);
    $this->container->insert($obj->getHash(), $obj, $priority);
    return $obj;
  }

  /**
   * Sets a meta data object
   *
   * @param  string $path
   * @param  int $priority
   * @return ExternalScript
   */
  public function setScriptSrc(string $path, int $priority = 0): ExternalScript {
    $obj = new ExternalScript($path);
    $this->container->insert($obj->getHash(), $obj, $priority);
    return $obj;
  }

  public function getHtml(): string {
    $out = '';
    foreach ($this->container as $metaObj) {
      $out .= $metaObj;
    }
    return $out;
  }

  public function getIterator(): ContentIterator {
    return new ContentIterator($this->container);
  }

  public function count(): int {
    return $this->container->count();
  }

}
