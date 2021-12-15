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

use Sphp\Documentation\Linkers\ApiUrlGenerator;

/**
 * Description of HTML documentation URL generator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface HtmlUrlGenerator extends ApiUrlGenerator {

  /**
   * 
   * @param  string|null $tagName optional tagname
   * @param  string|null $attrName optional attributename
   * @return string the URL pointing to the manual page
   */
  public function getUrl(?string $tagName = null, ?string $attrName = null): string;

}
