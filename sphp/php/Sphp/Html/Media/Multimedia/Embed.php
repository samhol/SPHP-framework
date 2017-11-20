<?php

/**
 * Embed.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\LazyMedia;
use Sphp\Html\Media\SizeableMedia;

/**
 * Implements an HTML &lt;embed&gt; tag
 *
 * This component defines a container for an external application or
 * interactive content (a plug-in).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_embed.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Embed extends EmptyTag implements LazyMedia, SizeableMedia {

  use \Sphp\Html\Media\SizeableTrait,
      \Sphp\Html\Media\LazyMediaSourceTrait;

  /**
   * Constructs a new instance
   *
   * @param string $src specifies the address of the external file to embed
   * @param string $type specifies the MIME type of the embedded content
   * @link  http://www.w3schools.com/tags/att_embed_src.asp src attribute
   * @link  http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function __construct(string $src = null, string $type = null) {
    parent::__construct('embed');
    if ($src !== null) {
      $this->setSrc($src);
    }
    if ($type !== null) {
      $this->setType($type);
    }
  }

  /**
   * Sets the MIME type of the embedded component
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @param  string $type the MIME type of the embedded component
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function setType(string $type) {
    $this->attrs()->set('type', $type);
    return $this;
  }

  /**
   * Returns the value of the type attribute (The MIME type)
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @return string The MIME type of the embedded component or null if the MIME type is not set
   * @link  http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function getType() {
    return $this->attrs()->getValue('type');
  }

}
