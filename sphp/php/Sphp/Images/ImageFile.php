<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

/**
 * The ImageFile class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ImageFile {

  private $src;

  /**
   * Constructor
   * 
   * @param string $src to the image file
   */
  public function __construct(string $src) {
    $this->src = $src;
  }

  /**
   * Checks if the given path points to an image file
   *
   * @return bool true if the given path points to an image file; false otherwise
   */
  public static function isImage(): bool {
    return \getimagesize($this->src) !== false;
  }

}
