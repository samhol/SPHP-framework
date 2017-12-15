<?php

/**
 * Object.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\EmptyTag;
/**
 * Description of Object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-12-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Object extends EmptyTag implements Embeddable {

  use LazyMediaSourceTrait,
      SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $src the address of the document to embed in the object
   * @param  string $name the value of the name attribute
   * @link   http://www.w3schools.com/TAGS/att_iframe_src.asp src attribute
   */
  public function __construct(string $src = null, string $name = null) {
    parent::__construct('iframe', true);
    if ($src !== null) {
      $this->setSrc($src);
    }
    if ($name !== null) {
      $this->setName($name);
    }
  }
}
