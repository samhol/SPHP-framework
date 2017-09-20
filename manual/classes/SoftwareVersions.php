<?php

/**
 * SoftwareVersions.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual;

/**
 * Description of SoftwareVersions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SoftwareVersions {

  public static function geshi(): string {
    return (new \GeSHi)->get_version();
  }

  public static function doctrineCommon(): string {
    return \Doctrine\Common\Version::VERSION;
  }

  public static function doctrineDBAL(): string {
    return \Doctrine\DBAL\Version::VERSION;
  }

  public static function doctrineORM(): string {
    return \Doctrine\ORM\Version::VERSION;
  }

  public static function doctrineCommonCache(): string {
    return \Doctrine\Common\Cache\Version::VERSION;
  }

  public static function parsedown(): string {
    return \ParsedownExtra::version;
  }

  public static function parsedownExtra(): string {
    return \ParsedownExtra::version;
  }

  public static function parsedownExtraPlugin(): string {
    return \ParsedownExtraPlugin::version;
  }

}
