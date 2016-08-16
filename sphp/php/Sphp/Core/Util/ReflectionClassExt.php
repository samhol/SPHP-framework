<?php

/**
 * ReflectionClassExt.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Util;

/**
 * Class extends PHP's native {@link \ReflectionClass}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ReflectionClassExt extends \ReflectionClass {

  /**
   * Returns the names of the classes implementing the given interface
   *
   * @param  string $interfaceName the name of the interface
   * @return string[] implementing classes
   */
  public static function getImplementingClasses($interfaceName) {
    $filter = function($className) use ($interfaceName) {
      return in_array($interfaceName, class_implements($className));
    };
    $arr = array_filter(get_declared_classes(), $filter);
    sort($arr);
    return $arr;
  }

  /**
   * Obtains an object class name without namespaces
   *
   * @param  string|\object $namespace the namespace or the object
   * @return string[] an object class name without namespaces
   */
  public static function parseNamespace($namespace) {
    try {
      $reflectedClass = new \ReflectionClass($namespace);
      $ns = $reflectedClass->getNamespaceName();
    } catch (\Exception $ex) {
      $ns = preg_replace('/(\\{2,})/i', "\\", $namespace);
    }
    return $ns;
  }

  /**
   * Obtains an object class name without namespaces
   *
   * @param  \object $namespace the namespace or the object
   * @return string[] an object class name without namespaces
   */
  public static function parseNamespaceToArray($namespace = __NAMESPACE__) {
    return explode('\\', self::parseNamespace($namespace));
  }

}
