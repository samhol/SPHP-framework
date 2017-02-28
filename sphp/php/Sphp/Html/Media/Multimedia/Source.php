<?php

/**
 * Source.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\LazyLoaderInterface;
use Sphp\Html\Media\LazyLoaderTrait;
use Sphp\Stdlib\URL;

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
 * @since   2014-11-14
 * @link    http://www.w3schools.com/tags/tag_source.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-source-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Source extends EmptyTag implements MultimediaContentInterface, LazyLoaderInterface {

  use LazyLoaderTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|URL|null $src the URL of the media file or null for none
   * @param  string|null $type the media type of the media resource or null for none
   * @param  boolean $lazy true for lazy loading and false otherwise
   * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function __construct($src = null, $type = null, $lazy = false) {
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
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function setType($type) {
    $this->attrs()->set('type', $type);
    return $this;
  }

  /**
   * Returns the media type of the media resource
   *
   * @return string the media type of the media resource
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function getType() {
    return $this->attrs()->get('type');
  }

}
