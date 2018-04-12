<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Stdlib\Arrays;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class HeadFactory {

  public static function fromArray(array $meta): Head {
    $group = new Head();
    foreach ($meta as $tag) {
      if (is_array($tag)) {
        if (array_key_exists('meta', $tag)) {
          $group->set(new MetaTag($tag['meta']));
        }
        if (array_key_exists('link', $tag)) {
          if (Arrays::isIndexed($tag)) {
            foreach ($tag['link'] as $link) {
              $group->set(Link::fromArray($link));
            }
          } else {
            $group->set(Link::fromArray($tag['link']));
          }
        }
        if (array_key_exists('title', $tag)) {
          $group->set(new Title($tag['title']));
        }
      }
    }
    return $group;
  }

}
