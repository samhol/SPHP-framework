<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Content;

/**
 * Defines properties for a Foundation Responsive Embed component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/flex_video.html Foundation Flex Video
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface ResponsiveEmbedInterface extends Content {

  /**
   * Sets/unsets the aspect ratio
   * 
   * Predefined aspect ratios:
   * 
   * * `default`: 4 by 3
   * * `widescreen`: 16 by 9
   * * `panorama`: 256 by 81
   * * `square`: 1 by 1
   * 
   * @param  string $ratio the ratio 
   * @return $this for a fluent interface
   */
  public function setAspectRatio(string $ratio);
}
