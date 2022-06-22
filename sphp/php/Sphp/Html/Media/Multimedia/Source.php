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

use Sphp\Html\EmptyTag;
use Sphp\Html\Utils\Mime;

/**
 * Implementation of an HTML source tag
 *
 *  This component specifies media resources for {@link AbstractMediaTag} components.
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
class Source extends EmptyTag implements MultimediaSource {

  /**
   * Constructor
   *
   * @param  string $src the URL of the media file or null for none
   * @param  string|null $type the media type of the media resource or null for none
   * @link   https://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   https://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function __construct(string $src, ?string $type = null) {
    parent::__construct('source');
    if ($src !== null) {
      $this->setSrc($src);
    }
    if ($type === null) {
      $type = Mime::getMime($src);
    }
    $this->setType($type);
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @param  string|null $type the media type of the media resource or null for none
   * @return $this for a fluent interface
   */
  public function setSrc(string $src, ?string $type = null) {
    if ($type === null) {
      $type = Mime::getMime($src);
    }
    $this->attributes()->setAttribute('src', $src);
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    return (string) $this->attributes()->getValue('src');
  }

  /**
   * Sets the media type of the media resource
   *
   * @param  string|null $type the media type of the media resource
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function setType(?string $type = null) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the media type of the media resource
   *
   * @return string|null the media type of the media resource
   * @link   https://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function getType(): ?string {
    return $this->attributes()->getValue('type');
  }

}
