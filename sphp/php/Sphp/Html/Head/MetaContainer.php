<?php

/**
 * MetaTagContainer.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\ContentInterface;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Container;
use Sphp\Html\TraversableInterface;
use Sphp\Html\NonVisualContent;

/**
 * Class is a container for a {@link MetaInterface} component group
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MetaContainer implements ContentInterface, Iterator, TraversableInterface, NonVisualContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * the inner container for the {@link MetaInterface} components
   *
   * @var MetaData[]
   */
  private $metaTags = [];

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->metaTags);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->metaTags = Arrays::copy($this->metaTags);
  }

  /**
   * Adds a meta data object to the container
   *
   * @param  MetaData $content meta information to add
   * @return $this for a fluent interface
   */
  public function addMeta(MetaData $content) {
    if ($content->attrExists('charset')) {
      $this->metaTags['charset'] = $content;
    } else if ($content->hasNamedContent()) {
      $this->metaTags['name'][$content->getName()] = $content;
    } else if ($content->hasHttpEquivContent()) {
      $this->metaTags['http-equiv'][$content->getHttpEquiv()] = $content;
    } else if ($content->hasPropertyContent()) {
      $this->metaTags['property'][$content->getProperty()] = $content;
    }
    return $this;
  }

  public function getHtml(): string {
    return implode('', Arrays::flatten($this->metaTags));
  }

  public function count(): int {
    $this->metaTags->count();
  }


  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->metaTags);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->metaTags);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->metaTags);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->metaTags);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->metaTags);
  }
}
