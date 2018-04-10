<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\Content;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Html\TraversableContent;
use Sphp\Html\NonVisualContent;

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
class MetaGroup implements Content, Iterator, TraversableContent, NonVisualContent {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * the inner container for the {@link MetaInterface} components
   *
   * @var MetaData[]
   */
  private $metaData = [];

  public function __construct() {
    ;
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
    $this->metaData = Arrays::copy($this->metaData);
  }

  /**
   * Sets a meta data object
   *
   * @param  MetaData $content meta information to add
   * @return $this for a fluent interface
   */
  public function set(MetaData $content) {

    $key = null;
    $contains = false;
    foreach ($this->metaData as $k => $meta) {
      $contains = $content->overlaps($meta);
      if ($contains) {
        $key = $k;
        break;
      }
    }
    if ($key === null) {
      $this->metaData[] = $content;
    } else {
      $this->metaData[$key] = $content;
    }
    return $this;
  }

  public function contains(MetaData $cont): bool {

    //return null === array_search ($content, $this->metaData);
    $key = -1;
    $contains = false;
    foreach ($this->metaData as $k => $content) {
      $contains = $content->overlaps($cont);
      if ($contains) {
        $key = $k;
        break;
      }



      // print_r(array_intersect_assoc($a, $cont->metaToArray()));
      /* if ($cont->attributeExists('charset') && $content->attributeExists('charset')) {
        $key = $k;
        break;
        } else if ($content->hasName($cont->getName()) && $content->hasName($cont->getName())) {
        $this->metaData['name'][$content->getName()] = $content;
        } else if ($content->hasHttpEquivContent()) {
        echo "\n" . $content->getHttpEquiv();
        $this->metaData['http-equiv'][$content->getHttpEquiv()] = $content;
        } else if ($content->hasPropertyContent()) {
        $this->metaData['property'][$content->getProperty()] = $content;
        } */
    }
    return $contains;
  }

  public function getHtml(): string {
    return implode(Arrays::flatten($this->metaData));
  }

  public function count(): int {
    $this->metaData->count();
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->metaData);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->metaData);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->metaData);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->metaData);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->metaData);
  }

  public static function fromArray(array $meta): MetaGroup {
    $group = new MetaGroup;
    foreach ($meta as $tag) {
      $group->set(new Meta($tag));
    }
    return $group;
  }

}
