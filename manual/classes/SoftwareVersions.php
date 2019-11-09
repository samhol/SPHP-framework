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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SoftwareVersions {

  public function getImagineVersion(): string {
    return \Imagine\Image\ImagineInterface::VERSION;
  }

  /**
   * 
   * @return string
   */
  public static function geshi(): string {
    return (new \GeSHi)->get_version();
  }

  /**
   * 
   * @return string
   */
  public static function doctrineCommon(): string {
    return \Doctrine\Common\Version::VERSION;
  }

  /**
   * 
   * @return string
   */
  public static function doctrineDBAL(): string {
    return \Doctrine\DBAL\Version::VERSION;
  }

  /**
   * 
   * @return string
   */
  public static function doctrineORM(): string {
    return \Doctrine\ORM\Version::VERSION;
  }

  /**
   * 
   * @return string
   */
  public static function doctrineCommonCache(): string {
    return \Doctrine\Common\Cache\Version::VERSION;
  }

  /**
   * 
   * @return string
   */
  public static function parsedown(): string {
    return \ParsedownExtra::version;
  }

  /**
   * 
   * @return string
   */
  public static function parsedownExtra(): string {
    return \ParsedownExtra::version;
  }

  /**
   * 
   * @return string
   */
  public static function parsedownExtraPlugin(): string {
    return \ParsedownExtraPlugin::version;
  }

}
