<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection\Utils;

use Sphp\Stdlib\Strings;

/**
 * Class NamespaceUtils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class NamespaceUtils {

  public static function isValidNamespace(string $namespace): bool {
    return Strings::match($namespace, '/(^$)|(^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*(\\\\[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*)*$)/');
  }

  /**
   * 
   * @param  string $namespace
   * @return string[]
   */
  public static function explodeNamespaceArray(string $namespace): array {
    $namespaceArray = explode('\\', $namespace);
    $ns = [];
    $namespaces = [];
    foreach ($namespaceArray as $subNamespace) {
      $ns[] = "$subNamespace";
      $namespaces[] = implode('\\', $ns);
    }
    return $namespaces;
  }

  /**
   * Checks if parent namespace contains child namespace 
   * 
   * @param  string $parent
   * @param  string $sub
   * @return bool true if child and parent are matches
   */
  public static function isChildNamespaceOf(string $parent, string $sub): bool {
    $result = true;
    $subPieces = explode('\\', trim($sub, '\\'));
    $parentPieces = explode('\\', trim($parent, '\\'));
    // echo "\nsub:\t" . count($subPieces);
    // echo "\nparent:\t" . count($parentPieces);
    //var_dump(count($subPieces) < count($parentPieces));
    if (count($subPieces) < count($parentPieces)) {
      $result = false;
    } else {
      foreach ($parentPieces as $id => $parentPiece) {
        if ($subPieces[$id] !== $parentPiece) {
          $result = false;
          break;
        }
      }
    }
    return $result;
  }

}
