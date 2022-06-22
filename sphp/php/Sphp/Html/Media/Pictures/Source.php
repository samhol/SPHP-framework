<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures;

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML source tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Source extends EmptyTag {

  /**
   * Constructor
   * 
   * @param string $srcset
   * @param string|null $media
   * @param string|null $type
   */
  public function __construct(string $srcset, ?string $media = null, ?string $type = null) {
    parent::__construct('source', false);
    $this->setSrcset($srcset);
    $this->setMedia($media);
    $this->setType($type);
  }

  /**
   * Sets the srcset attribute
   * 
   * @param  string $srcset the value of the srcset attribute
   * @return $this for a fluent interface
   */
  public function setSrcset(string $srcset) {
    $this->setAttribute('srcset', $srcset);
    return $this;
  }

  /**
   * Sets the media attribute
   * 
   * @param  string|null $media the value of the media attribute
   * @return $this for a fluent interface
   */
  public function setMedia(?string $media = null) {
    $this->setAttribute('media', $media);
    return $this;
  }

  /**
   * Sets the type attribute
   * 
   * @param  string|null $type the value of the type attribute
   * @return $this for a fluent interface
   */
  public function setType(?string $type = null) {
    $this->setAttribute('type', $type);
    return $this;
  }

}
