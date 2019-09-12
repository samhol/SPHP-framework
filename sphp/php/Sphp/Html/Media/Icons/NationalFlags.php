<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Media\Image\SvgLoader;
use Sphp\Html\Media\Image\Svg;
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

  public function __construct(string $rootFolder) {
    $this->rootFolder = $rootFolder;
  }

  public function getFlagOf(string $countryCode): Svg {
    return SvgLoader::instance()->fileToObject("{$this->rootFolder}{$countryCode}.svg");
  }

}
