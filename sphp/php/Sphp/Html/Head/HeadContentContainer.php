<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractContent;
use IteratorAggregate;
use Traversable;
use Sphp\Html\TraversableContent;
use Sphp\Html\NonVisualContent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Scripts\Script;
use Sphp\Exceptions\UnderflowException;

/**
 * Container for HTML &lt;head&gt; components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HeadContentContainer extends AbstractContent implements IteratorAggregate, TraversableContent, NonVisualContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var PlainContainer
   */
  private $container;

  /**
   * Constructor
   */
  public function __construct() {
    $this->container = new PlainContainer;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->container);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->container = clone $this->container;
  }

  /**
   * Sets a head content component
   * 
   * @param  HeadContent $component head content component
   * @return $this for a fluent interface
   */
  public function set(HeadContent $component) {
    $inserted = false;
    if (!$component instanceof OverlappingHeadContent) {
      $this->container[] = $component;
    } else {
      $inserted = false;
      foreach ($this->container as $k => $content) {
        if ($content instanceof OverlappingHeadContent && $content->overlapsWith($component)) {
          $this->container[$k] = $component;
          $inserted = true;
          break;
        }
      }
      if (!$inserted) {
        $this->container[] = $component;
      }
    }
    return $this;
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  Title $title the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle(Title $title = null) {
    $inserted = false;
    foreach ($this->container as $k => $meta) {
      if ($meta instanceof Title) {
        if ($title === null) {
          unset($this->container[$k]);
        } else {
          $this->container[$k] = $title;
        }
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->container[] = $title;
    }
    return $this;
  }

  public function getTitle(): Title {
    foreach ($this->container as $meta) {
      if ($meta instanceof Title) {
        return $meta;
      }
    }
    throw new UnderflowException('Title component is not present');
  }

  /**
   * Sets/removes the base address of the HTML page
   * 
   * @param  Base $base the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setBaseAddress(Base $base = null) {
    $inserted = false;
    foreach ($this->container as $k => $meta) {
      if ($meta instanceof Base) {
        if ($base === null) {
          unset($this->container[$k]);
        } else {
          $this->container[$k] = $base;
        }
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->container[] = $base;
    }
    return $this;
  }

  public function getBase(): Base {
    foreach ($this->container as $meta) {
      if ($meta instanceof Base) {
        return $meta;
      }
    }
    throw new UnderflowException('Base component is not present');
  }

  /**
   * Sets a meta data object
   *
   * @param  MetaData $content meta information to add
   * @return $this for a fluent interface
   */
  public function setMeta(MetaData $content) {
    $contains = false;
    foreach ($this as $key => $component) {
      if ($component instanceof MetaData) {
        $contains = $content->overlapsWith($component);
        if ($contains) {
          $this->container[$key] = $content;
          break;
        }
      }
    }
    if (!$contains) {
      $this->container[] = $content;
    }
    return $this;
  }

  /**
   * Sets a link tag object
   *
   * @param  LinkTag $link meta information to add
   * @return $this for a fluent interface
   */
  public function setLink(LinkTag $link) {
    $contains = false;
    foreach ($this->container as $k => $component) {
      if ($component instanceof LinkTag) {
        $contains = $link->overlapsWith($component);
        if ($contains) {
          $this->container[$k] = $link;
          break;
        }
      }
    }
    if (!$contains) {
      $this->container[] = $link;
    }
    return $this;
  }

  /**
   * Sets a meta data object
   *
   * @param  Script $content meta information to add
   * @return $this for a fluent interface
   */
  public function setScript(Script $content) {
    $this->container[] = $content;
    return $this;
  }

  /**
   * 
   * @return PlainContainer
   */
  public function getMeta(): PlainContainer {
    return $this->container->getComponentsByObjectType(MetaData::class);
  }

  /**
   * 
   * @return PlainContainer
   */
  public function getLinks(): PlainContainer {
    return $this->container->getComponentsByObjectType(LinkTag::class);
  }

  /**
   * 
   * @return PlainContainer
   */
  public function getScripts(): PlainContainer {
    return $this->container->getComponentsByObjectType(Script::class);
  }

  public function getHtml(): string {
    return $this->container->getHtml();
  }
  
  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->container->getIterator();
  }

}
