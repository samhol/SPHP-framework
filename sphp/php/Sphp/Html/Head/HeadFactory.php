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
 * Factory for HTML &lt;head&gt; components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class HeadFactory {

  /**
   * Creates an HTML &lt;head&gt; component from given array of data
   * 
   * @param  array $meta the data to insert into the head
   * @return Head new instance
   */
  public static function fromArray(array $meta): Head {
    $group = new Head();
    foreach ($meta as $tag) {
      if (is_array($tag)) {
        if (array_key_exists('meta', $tag)) {
          $group->set(new MetaTag($tag['meta']));
        } else if (array_key_exists('meta:charset', $tag) && is_string($tag['meta:charset'])) {
          $group->set(Meta::charset($tag['meta:charset']));
        } else if (array_key_exists('meta:http-equiv', $tag)) {
          $group->set(Meta::httpEquiv($tag['meta:http-equiv'], $tag['content']));
        } else if (array_key_exists('meta:name', $tag)) {
          $group->set(Meta::httpEquiv($tag['meta:name'], $tag['content']));
        } else if (array_key_exists('link', $tag)) {
          $link = new LinkTag($tag['link']);
          $group->set($link);
        }
        if (array_key_exists('title', $tag)) {
          $group->set(new Title($tag['title']));
        }
      }
    }
    return $group;
  }

}
