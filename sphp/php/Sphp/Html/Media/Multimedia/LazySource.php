<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\LazyMediaSource;
use Sphp\Html\Utils\Mime;

/**
 * Implementation of a lazy loading HTML source tag
 *
 *  This component specifies media resources for video components.
 *
 *  This component allows you to specify alternative video/audio files which 
 *   the browser may choose from, based on its media type or codec support.
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_source.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-source-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LazySource extends Source implements LazyMediaSource {

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @param  string|null $type the media type of the media resource or null for none
   * @return $this for a fluent interface
   */
  public function setSrc(string $src, string $type = null) {
    if ($type === null) {
      $type = Mime::getMime($src);
    }
    $this->attributes()->setAttribute('data-src', $src);
    $this->setType($type);
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    return (string) $this->attributes()->getValue('data-src');
  }

}
