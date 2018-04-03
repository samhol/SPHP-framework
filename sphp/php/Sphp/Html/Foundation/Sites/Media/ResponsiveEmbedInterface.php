<?php

/**
 * ResponsiveEmbedInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Content;

/**
 * Defines properties for a Foundation Responsive Embed component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/flex_video.html Foundation Flex Video
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
