<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Stdlib\BitMask;

/**
 * Implements user's rights
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @Embeddable
 */
class Permissions extends BitMask {

  /**
   * Permissions flag for no rights (0)bin
   */
  const NOTHING = 0;

  /**
   * Permissions flag for reading rights (1)bin
   */
  const READ = 0b1;

  /**
   * Permissions flag for writing rights (10)bin
   */
  const WRITE = 0b10;

  /**
   * Permissions flag for reading and writing rights (11)bin
   */
  const RW = 0b11;

  /**
   * Permissions flag for administration rights (100)bin
   */
  const ADMIN = 0b100;

  /**
   * Permissions flag for reading, writing and administrationing rights (111)bin
   */
  const ALL_RIGHTS = 0b111;

}
