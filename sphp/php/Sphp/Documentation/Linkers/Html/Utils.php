<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\Html;

use Sphp\Html\Tags;
use Sphp\Html\Span;

/**
 * Description of Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Utils {

  /**
   * 
   * @param  string $tagName
   * @return Span
   */
  public static function createTagContent(string $tagName): Span {
    $linkText = Tags::span();
    $linkText->append(Tags::span('&lt;')->addCssClass('bracket left'));
    $linkText->append(Tags::span($tagName)->addCssClass('tagname'));
    $linkText->append(Tags::span('&gt;')->addCssClass('bracket right'));
    return $linkText;
  }

}
