<?php

/**
 * FlexInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\ContentInterface;

/**
 * Defines properties for a Foundation 6 Flex component
 *
 * Flex Video lets browsers automatically scale video objects in webpages. If a 
 * video is embedded from YouTube, Vimeo, or another site that uses iframe, 
 * embed or object elements, video can be wrap into {@link self} to create 
 * an intrinsic ratio that will properly scale the video on any device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/flex_video.html Flex Video
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ResponsiveEmbedInterface extends ContentInterface {

  /**
   * Sets/unsets the widescreen property
   * 
   * Predefined aspect ratios:
   * 
   * * `default`: 4 by 3
   * * `widescreen`: 16 by 9
   * * `panorama`: 256 by 81
   * * `square`: 1 by 1
   * 
   * @param  string $ratio true for widescreen
   * @return self for a fluent interface
   */
  public function setAspectRatio($ratio);
}
