<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Images;

use SplFileObject;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Class contains some image manipulation tools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractImage implements Image {

  /**
   * the original image
   *
   * @var SplFileObject 
   */
  private $src;

  /**
   * Constructor
   * 
   * @param  string $src
   * @throws InvalidArgumentException
   */
  public function __construct(string $src) {
    try {
      $this->src = new SplFileObject($src, 'r', true);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->src);
  }

  public function getOriginalSrc(): string {
    return $this->src->getPathname();
  }

  /**
   * Returns image file extension of the source
   *
   * @return string image file extension of the source
   */
  public function getExtension(): string {
    return $this->src->getExtension();
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string {
    return $this->createImage()->show($this->getExtension());
  }

}
