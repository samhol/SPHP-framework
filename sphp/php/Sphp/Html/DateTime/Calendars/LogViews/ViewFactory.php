<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Media\Icons\Svg;

/**
 * Description of FlagView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ViewFactory {

  public static function flag(string $country): string {
    return '<span class="national-flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/fi.svg') . "</span>";
    return '<span class="national-flag"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 1100">
<rect width="1800" height="1100" fill="#fff"/>
<rect width="1800" height="300" y="400" fill="#003580"/>
<rect width="300" height="1100" x="500" fill="#003580"/>
</svg></span>';
  }

}
