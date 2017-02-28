<?php

/**
 * MetaTagContainer.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\ContentInterface;
use IteratorAggregate;
use Sphp\Html\Container;
use Sphp\Html\TraversableInterface;

/**
 * Class is a container for a {@link MetaInterface} component group
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MetaContainer implements ContentInterface, IteratorAggregate, TraversableInterface {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\TraversableTrait;

  /**
   * the inner container for the {@link MetaInterface} components
   *
   * @var Container
   */
  private $metaTags;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->metaTags = new Container();
  }

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
    $this->metaTags = clone $this->metaTags;
  }

  /**
   * Adds a meta data object to the container
   *
   * @param  MetaInterface $content meta information to add
   * @return self for a fluent interface
   */
  public function addMeta(MetaInterface $content) {
    $key = [];
    if ($content->attrExists('charset')) {
      $key[] = 'charset';
    } if ($content->hasNamedContent()) {
      $key[] = "name-" . $content->getName();
    } if ($content->hasHttpEquivContent()) {
      $key[] = "http-equiv-" . $content->getHttpEquiv();
    } if ($content->hasPropertyContent()) {
      $key[] = "property-" . $content->getProperty();
    }
    $k = implode("-", $key);
    $this->metaTags[$k] = $content;
    return $this;
  }

  public function getHtml() {
    return $this->metaTags->getHtml();
  }

  public function getIterator() {
    return $this->metaTags->getIterator();
  }

  public function count() {
    $this->metaTags->count();
  }

}
