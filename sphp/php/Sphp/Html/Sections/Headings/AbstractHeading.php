<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Sections\Headings;

use Sphp\Html\ContainerTag;
use Sphp\Html\Sections\Small;
/**
 * Abstract implementation of HTML headings and sub headings
 *
 * HTML heading Components rank in importance according to the number in their name.
 * The h1 element is said to have the highest rank, the h6 element has the lowest 
 * rank, and two elements with the same name have equal rank.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_hn.asp w3schools API
 * @link    https://html.spec.whatwg.org/#the-h1,-h2,-h3,-h4,-h5,-and-h6-elements W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractHeading extends ContainerTag implements HeadingInterface {

  public function getLevel(): int {
    return (int) substr($this->getTagName(), 1);
  }
  
  public function appendSmall($content): Small {
    $small =new Small($content);
    $this->append($small);
    return $small;
  }

}
