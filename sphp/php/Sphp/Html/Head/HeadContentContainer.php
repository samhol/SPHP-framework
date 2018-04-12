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
use Sphp\Html\Programming\ScriptTag;

/**
 * Container for metadata components
 *
 *  The &lt;meta&gt; tag provides meta data about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
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
  private $metaData;

  public function __construct() {
    $this->metaData = new Container;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->metaData);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->metaData = clone $this->metaData;
  }

  public function set(HeadContent $component) {
    if ($component instanceof Title) {
      $this->setDocumentTitle($component);
    } else if ($component instanceof Base) {
      $this->setBaseAddress($component);
    } else if ($component instanceof LinkInterface) {
      $this->setLink($component);
    } else if ($component instanceof MetaData) {
      $this->setMeta($component);
    } else if ($component instanceof ScriptTag) {
      $this->setScript($component);
    } else {
      $this->content()->append($component);
    }
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  Title $title the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle(Title $title) {
    $inserted = false;
    foreach ($this->metaData as $k => $meta) {
      if ($meta instanceof Title) {
        $this->metaData[$k] = $title;
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->metaData[] = $title;
    }
    return $this;
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  Base $title the title of the HTML page
   * @return $this for a fluent interface
   */
  public function setBaseAddress(Base $title) {
    $inserted = false;
    foreach ($this->metaData as $k => $meta) {
      if ($meta instanceof Base) {
        $this->metaData[$k] = $title;
        $inserted = true;
        break;
      }
    }
    if (!$inserted) {
      $this->metaData[] = $title;
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
    $key = null;
    $contains = false;
    foreach ($this as $k => $meta) {
      if ($meta instanceof MetaData) {
        $contains = $content->overlapsWith($meta);
        if ($contains) {
          $key = $k;
          break;
        }
      }
    }
    if ($key === null) {
      $this->metaData[] = $content;
    } else {
      $this->metaData[$key] = $content;
    }
    return $this;
  }

  /**
   * Sets a link tag object
   *
   * @param  LinkTag $content meta information to add
   * @return $this for a fluent interface
   */
  public function setLink(LinkTag $content) {
    $key = null;
    $contains = false;
    foreach ($this->metaData as $k => $meta) {
      if ($meta instanceof LinkTag) {
        $contains = $content->equals($meta);
        if ($contains) {
          $key = $k;
          break;
        }
      }
    }
    if ($key === null) {
      $this->metaData[] = $content;
    } else {
      $this->metaData[$key] = $content;
    }
    return $this;
  }

  /**
   * Sets a meta data object
   *
   * @param  MetaData $content meta information to add
   * @return $this for a fluent interface
   */
  public function setScript(ScriptTag $content) {
    $this->metaData[] = $content;
    return $this;
  }

  public function getMetaTags(): Container {
    return $this->metaData->getComponentsByObjectType(MetaData::class);
  }

  public function getLinkTags(): Container {
    return $this->metaData->getComponentsByObjectType(LinkTag::class);
  }

  public function getHtml(): string {
    return $this->metaData->getHtml();
  }

  public function count(): int {
    $this->metaData->count();
  }

  /**
   * Creates a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->metaData->getIterator();
  }

}
