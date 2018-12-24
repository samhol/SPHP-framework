<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Flow\Headings;

use Sphp\Html\ContainerTag;

/**
 * Abstract implementation of HTML headings and sub headings
 *
 * HTML heading Components rank in importance according to the number in their name.
 * The h1 element is said to have the highest rank, the h6 element has the lowest 
 * rank, and two elements with the same name have equal rank.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_hn.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-h1-h2-h3-h4-h5-and-h6-elements W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractHeading extends ContainerTag implements HeadingInterface {

  public function getLevel(): int {
    return (int) substr($this->getTagName(), 1);
  }

}
