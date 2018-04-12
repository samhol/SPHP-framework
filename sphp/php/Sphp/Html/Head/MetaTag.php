<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;meta&gt; tag
 *
 *  The &lt;meta&gt; tag provides metadata about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parsable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MetaTag extends EmptyTag implements MetaData {

  /**
   * Constructs a new instance
   * 
   * @param  string[] $meta an array of attribute name value pairs
   */
  public function __construct(array $meta = []) {
    parent::__construct('meta');
    $this->attributes()->merge($meta);
  }
  
  public function setsCharset(): bool {
    return $this->attributeExists('charset');
  }

  public function hasNamedContent(): bool {
    return $this->attributeExists('name');
  }

  public function hasName(string $name): bool {
    return $this->hasNamedContent() && $this->getName() == $name;
  }

  public function getName() {
    return $this->getAttribute('name');
  }

  public function hasHttpEquivContent(): bool {
    return $this->attributeExists('http-equiv');
  }

  public function hasHttpEquiv(string $http_equiv): bool {
    return $this->hasHttpEquivContent() && $this->attributes()->get('http-equiv') === $http_equiv;
  }

  public function getHttpEquiv() {
    return $this->attributes()->getValue('http-equiv');
  }

  public function hasPropertyContent(): bool {
    return $this->attributeExists('property');
  }

  /**
   * Checks whether the property attribute has the given value or not
   *
   * @param  string $property the property value of the metadata
   * @return boolean true if the property attribute has the given value, otherwise false
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function hasProperty(string $property): bool {
    return $this->hasPropertyContent() && $this->get('property') == $property;
  }

  /**
   * Returns the value of the property attribute
   *
   * @return string|null the value of the property attribute or null if the 
   *         attribute is not set
   * @link   http://ogp.me/ The Open Graph protocol
   * @link   https://developers.facebook.com/docs/concepts/opengraph/ Open Graph Concepts (Facebook)
   * @link   http://en.wikipedia.org/wiki/RDFa RDFa (Wikipedia)
   */
  public function getProperty() {
    return $this->getAttribute('property');
  }

  /**
   * Returns the meta data as an array
   * 
   * @return string[] meta data as an array
   */
  public function metaToArray(): array {
    return $this->attributes()->toArray();
  }

  public function overlapsWith(MetaData $meta): bool {
    if ($this->setsCharset() && $meta->setsCharset()) {
      return true;
    }  
    $same = array_intersect_assoc($this->metaToArray(), $meta->metaToArray());
    return array_key_exists('name', $same) || array_key_exists('http-equiv', $same);
  }

}
