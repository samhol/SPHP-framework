<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\LazyMedia;
use Sphp\Html\Media\LazyMediaSourceTrait;

/**
 * Implements an HTML &lt;source&gt; tag
 *
 *  This component specifies media resources for {@link AbstractMediaTag} components.
 *
 *  This component allows you to specify alternative video/audio files which 
 *   the browser may choose from, based on its media type or codec support.
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_source.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-source-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Source extends EmptyTag implements MultimediaSource, LazyMedia {

  use LazyMediaSourceTrait;

  /**
   * Constructor
   *
   * @param  string|null $src the URL of the media file or null for none
   * @param  string|null $type the media type of the media resource or null for none
   * @param  boolean $lazy true for lazy loading and false otherwise
   * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function __construct(string $src = null, string $type = null, bool $lazy = false) {
    parent::__construct('source');
    if ($src !== null) {
      $this->setSrc($src);
    }
    if ($type !== null) {
      $this->setType($type);
    }
    $this->setLazy($lazy);
  }

  /**
   * Sets the media type of the media resource
   *
   * @param  string $type the media type of the media resource
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function setType(string $type) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the media type of the media resource
   *
   * @return string the media type of the media resource
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function getType() {
    return $this->attributes()->getValue('type');
  }

}
