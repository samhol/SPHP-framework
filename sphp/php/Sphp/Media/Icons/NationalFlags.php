<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Media\Image\SvgLoader;
use Sphp\Media\Image\Svg;
use Sphp\Html\Media\Img;

/**
 * Implementation of NationalFlags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class NationalFlags {

  private $rootFolder;
  private $webRoot;

  public function __construct(?string $rootFolder = null, ?string $webRoot = null) {
    $this->rootFolder = $rootFolder;
    $this->webRoot = $webRoot;
  }

  public function getFlagOf(string $countryCode): Svg {
    return SvgLoader::instance()->fileToObject("{$this->rootFolder}{$countryCode}.svg");
  }

  public function img(string $countryCode): Img {
 
    $img = new Img("/svg-app/flags/$countryCode.svg", $countryCode);
    return $img;
  }


  public function imgFromISO3166(string $countryCode): Img {
    $code = strtolower($countryCode);
    $img = new Img("/countries-app/flags/$code.svg", $countryCode);
    return $img;
  }
}
