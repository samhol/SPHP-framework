<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use IteratorAggregate;
use Traversable;
use Sphp\Html\TraversableContent;
use Sphp\Html\NonVisualContent;
use Sphp\Html\Container;
use Sphp\Html\Programming\Script;

/**
 * Container for HTML &lt;head&gt; components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HeadContentContainer implements IteratorAggregate, TraversableContent, NonVisualContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * @var Container
   */
  private $container;

  /**
   * Constructor
   */
  public function __construct() {
    $this->container = new Container;
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
    if ($component instanceof Title) {
      $this->setDocumentTitle($component);
    } else if ($component instanceof Base) {
      $this->setBaseAddress($component);
    } else if ($component instanceof LinkInterface) {
      $this->setLink($component);
    } else if ($component instanceof MetaData) {
      $this->setMeta($component);
    } else if ($component instanceof Script) {
      $this->setScript($component);
    } else {
      $this->content()->append($component);
    }
    return $this;
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  Title $title the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle(Title $title) {
    $inserted = false;
    foreach ($this->container as $k => $meta) {
      if ($meta instanceof Title) {
        $this->container[$k] = $title;
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->container[] = $title;
    }
    return $this;
  }

  /**
   * Sets the base address of the HTML page
   *
   * @param  Base $base the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setBaseAddress(Base $base) {
    $inserted = false;
    foreach ($this->container as $k => $meta) {
      if ($meta instanceof Base) {
        $this->container[$k] = $base;
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->container[] = $base;
    }
    return $this;
  }

  /**
   * Removes the default URL and a default target for all links on a page
   *
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function unsetBaseAddress() {
    foreach ($this->container as $k => $meta) {
      if ($meta instanceof Base) {
        unset($this->container[$k]);
        break;
      }
    }
    return $this;
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
        $contains = $link->equals($component);
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
   * @return Container
   */
  public function getMetaTags(): Container {
    return $this->container->getComponentsByObjectType(MetaData::class);
  }

  /**
   * 
   * @return Container
   */
  public function getLinkTags(): Container {
    return $this->container->getComponentsByObjectType(LinkTag::class);
  }

  /**
   * 
   * @return Container
   */
  public function getScripts(): Container {
    return $this->container->getComponentsByObjectType(Script::class);
  }

  public function getHtml(): string {
    return $this->container->getHtml();
  }

  public function count(): int {
    $this->container->count();
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
