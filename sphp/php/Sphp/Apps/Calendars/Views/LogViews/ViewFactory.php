<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews;

use Sphp\Html\Media\Img;

/**
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ViewFactory {

  public static function flag(string $country): string {
    $img = new Img('https://samiholck.fi/countries-app/flags/fin.svg', 'Finnish flag');
    return '<div class="national-flag" style="width:20px;">' . $img . "</div>";
  }

}
