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
use Sphp\Html\Media\Embeddable;
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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Embed extends EmptyTag implements Embeddable, LazyMedia, SizeableMedia {

  use \Sphp\Html\Media\SizeableMediaTrait,
      \Sphp\Html\Media\LazyMediaSourceTrait;

  /**
   * Constructor
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
    $this->attributes()->setAttribute('type', $type);
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
    return $this->attributes()->getValue('type');
  }

}
