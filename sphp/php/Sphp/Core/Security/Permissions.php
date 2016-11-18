<?php

/**
 * Permissions.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Security;

use Sphp\Core\Types\BitMask;

/**
 * Class Models user's rights
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
