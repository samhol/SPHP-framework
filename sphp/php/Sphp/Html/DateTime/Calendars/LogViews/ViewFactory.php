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
    return '<div class="national-flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/fi.svg') . "</div>";
  }
}
