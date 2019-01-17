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
use Sphp\Stdlib\Strings;

/**
 * Implements an HTML &lt;link&gt; tag
 *
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_link.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LinkTag extends EmptyTag implements LinkInterface {

  /**
   * Constructor
   *
   * @param  string[] $attrs an array of attribute name value pairs
   */
  public function __construct(array $attrs = []) {
    parent::__construct('link');
    $this->attributes()->merge($attrs);
  }

  /**
   * Sets the value of the href attribute
   *
   * **Note:**
   * The href attribute specifies the location (URL) of the external
   *      resource (most often a style sheet file).
   *
   * @param  string $href the location of the linked document
   * @param  boolean $encode converts all applicable characters of the $url to HTML entities
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function setHref(string $href, bool $encode = true) {
    if ($encode) {
      $href = Strings::htmlEncode($href);
    }
    $this->attributes()->setAttribute('href', $href);
    return $this;
  }

  public function getHref(): string {
    return $this->attributes()->getValue('href');
  }

  public function getRel(): string {
    return $this->attributes()->getValue('rel');
  }

  /* public function equals(LinkTag $meta): bool {
    return $meta->getRel() === $this->getRel() && $meta->getHref() === $this->getHref() && $this->getMedia() === $meta->getMedia();
    } */

  /**
   * Returns the meta data as an array
   * 
   * @return string[] meta data as an array
   */
  public function toArray(): array {
    return $this->attributes()->toArray();
  }

  public function overlapsWith(HeadContent $other): bool {
    if (!$other instanceof LinkInterface) {
      return false;
    }
    $same = array_intersect_assoc($this->toArray(), $other->toArray());
    if (!array_key_exists('rel', $same) || !array_key_exists('href', $same)) {
      return false;
    }
    $result = false;
    $rel = $same['rel'];
    switch ($rel) {
      case 'icon':
        $result = array_key_exists('size', $same) || ($this->getAttribute('size') === $other->getAttribute('size'));
        break;
      case 'stylesheet':
        $result = array_key_exists('media', $same) || ($this->getAttribute('media') === $other->getAttribute('media'));
        break;
    }
    return $result;
  }

}
