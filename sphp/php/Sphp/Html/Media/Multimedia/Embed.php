<?php

/**
 * Embed.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\EmptyTag;
use Sphp\Html\Media\LazyLoaderInterface;
use Sphp\Html\Media\SizeableInterface;

/**
 * Implements an HTML &lt;embed&gt; tag
 *
 * This component defines a container for an external application or
 * interactive content (a plug-in).
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-15
 * @link    http://www.w3schools.com/tags/tag_embed.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Embed extends EmptyTag implements LazyLoaderInterface, SizeableInterface {

  use \Sphp\Html\Media\SizeableTrait,
      \Sphp\Html\Media\LazyLoaderTrait;

  /**
   * Constructs a new instance
   *
   * @param string $src specifies the address of the external file to embed
   * @param string $type specifies the MIME type of the embedded content
   * @link  http://www.w3schools.com/tags/att_embed_src.asp src attribute
   * @link  http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function __construct($src = null, $type = null) {
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
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function setType($type) {
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
    return $this->attrs()->get('type');
  }

}
