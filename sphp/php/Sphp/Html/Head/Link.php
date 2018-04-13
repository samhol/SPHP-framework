<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

/**
 * Implements an HTML &lt;link&gt; factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Link {

  /**
   * Adds an link which points to a CSS style sheet file to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $media the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public static function stylesheet(string $href, string $media = 'screen'): LinkTag {
    return (new LinkTag('stylesheet', $href, $media))->setType('text/css');
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $sizes specifies the sizes of icons for visual media
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_type.asp type attribute
   * @link   http://www.iana.org/assignments/media-types complete list of standard MIME types
   */
  public static function shortcutIcon(string $href, string $sizes = null): LinkTag {
    $link = new LinkTag('icon', $href);
    $link->setSizes($sizes);
    return $link;
  }

  /**
   * Creates a new &lt;link&gt; object
   *
   * @param  string $href the location of the linked document
   * @param  string $rel the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public static function fromArray(array $attributes): LinkTag {
    $link = new LinkTag();
    $link->attributes()->merge($attributes);
    return $link;
  }

  /**
   * Creates a new &lt;link&gt; object
   *
   * @param  string $href the location of the linked document
   * @param  string $rel the relationship between the current document and the linked one
   * @param  string $media what media/device the target resource is optimized for
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public static function create(string $href = null, string $rel = null, string $media = null): LinkTag {
    $link = new LinkTag($rel, $href, $media);
    return $link;
  }

}
