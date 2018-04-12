<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\Content;

/**
 * Defines an HTML media source
 *
 * This component represents a media source.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_img.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface MediaSource extends Content {

  /**
   * Sets the path to the media source (The URL of the file)
   *
   * @param  string $src the path to the media source (The URL of the file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src);

  /**
   * Returns the path to the media source (The URL of the file)
   * 
   * @return string the path to the media source (The URL of the file)
   */
  public function getSrc(): string;
}
