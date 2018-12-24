<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an HTML &lt;link&gt; factory
 * 
 * @method \Sphp\Html\Head\LinkTag alternate(string $href = null) creates a new HTML &lt;link rel="alternate"&gt; object
 * @method \Sphp\Html\Head\LinkTag author(string $href = null) creates a new HTML &lt;link rel="author"&gt; object
 * @method \Sphp\Html\Head\LinkTag help(string $href = null) creates a new HTML &lt;link rel="help"&gt; object
 * @method \Sphp\Html\Head\LinkTag license(string $href = null) creates a new HTML &lt;link rel="license"&gt; object
 * @method \Sphp\Html\Head\LinkTag next(string $href = null) creates a new HTML &lt;link rel="next"&gt; object
 * @method \Sphp\Html\Head\LinkTag prev(string $href = null) creates a new HTML &lt;link rel="prev"&gt; object
 * @method \Sphp\Html\Head\LinkTag pingback(string $href = null) creates a new HTML &lt;link rel="pingback"&gt; object
 * @method \Sphp\Html\Head\LinkTag search(string $href = null) creates a new HTML &lt;link rel="search"&gt; object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Link {

  private static $rels = [
      'alternate',
      'author',
      'dns-prefetch',
      'help',
      'license',
      'next',
      'pingback',
      'preconnect',
      'prefetch',
      'preload',
      'prerender',
      'prev',
      'search',
      'mask-icon'];

  /**
   * Creates a HTML meta object
   *
   * @param  string $rel the name of the component
   * @param  array $arguments 
   * @return MetaTag the corresponding meta component
   * @throws BadMethodCallException if the tag object does not exist
   */
  public static function __callStatic(string $rel, array $arguments): LinkTag {
    if (!in_array($rel, static::$rels)) {
      throw new BadMethodCallException("Method $rel does not exist");
    }
    $attrs['rel'] = $rel;
    if (count($arguments) > 0) {
      if (is_string($arguments[0])) {
        $attrs['href'] = $arguments[0];
      } else if (is_array($arguments[0])) {
        if (array_key_exists('rel', $arguments[0])) {
          throw new InvalidArgumentException('rel is not allowed');
        }
      }
    }
    try {
      return static::fromArray($attrs);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("Link object '$rel' could not be created from given arguments", 0, $ex);
    }
  }

  /**
   * Adds an link which points to a CSS style sheet file to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $media what media/device the target resource is optimized for
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_link_media.asp media attribute
   */
  public static function stylesheet(string $href, string $media = null): LinkTag {
    return static::fromArray(['rel' => 'stylesheet', 'href' => $href, 'media' => $media, 'type' => 'text/css']);
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $sizes specifies the sizes of icons for visual media
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public static function icon(string $href, string $sizes = null): LinkTag {
    return static::fromArray(['rel' => 'icon', 'href' => $href, 'sizes' => $sizes]);
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $sizes specifies the sizes of icons for visual media
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public static function appleTouchIcon(string $href, string $sizes = null): LinkTag {
    return static::fromArray(['rel' => 'apple-touch-icon', 'href' => $href, 'sizes' => $sizes]);
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public static function manifest(string $href): LinkTag {
    return static::fromArray(['rel' => 'manifest', 'href' => $href]);
  }

  /**
   * Adds a shortcut icon to the object
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $color specifies the sizes of icons for visual media
   * @return LinkTag new object
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public static function maskIcon(string $href, string $color = null): LinkTag {
    return static::fromArray(['rel' => 'mask-icon', 'href' => $href, 'color' => $color]);
  }

  /**
   * Creates a new &lt;link&gt; object
   *
   * @param  array $attributes attributes of the created object
   */
  public static function fromArray(array $attributes): LinkTag {
    if (!array_key_exists('rel', $attributes)) {
      throw new \Sphp\Exceptions\InvalidArgumentException('rel attribute is required but not found from input');
    }if (!array_key_exists('href', $attributes)) {
      throw new \Sphp\Exceptions\InvalidArgumentException('href attribute is required but not found from input');
    }
    $link = new LinkTag($attributes);
    return $link;
  }

}
