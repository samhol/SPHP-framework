<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Random;

/**
 * Description of UUID
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class UUID {

  /**
   * Generates v4 UUID
   *
   * @return string
   */
  public static function v4(): string {
    return implode('-', [
        bin2hex(random_bytes(4)),
        bin2hex(random_bytes(2)),
        bin2hex(chr((ord(random_bytes(1)) & 0x0F) | 0x40)) . bin2hex(random_bytes(1)),
        bin2hex(chr((ord(random_bytes(1)) & 0x3F) | 0x80)) . bin2hex(random_bytes(1)),
        bin2hex(random_bytes(6))
    ]);
  }

  /**
   * Generates v5 UUID
   * 
   * Version 5 UUIDs are named based. They require a namespace (another 
   * valid UUID) and a value (the name). Given the same namespace and 
   * name, the output is always the same.
   * 
   * @param	string $namespace a valid UUID
   * @param	string $name
   */
  public static function v5(string $namespace, string $name): string {
    if (!self::isValid($namespace)) {
      throw new \Sphp\Exceptions\InvalidArgumentException('Invalid namespace for v5 UUID');
    }
    // Get hexadecimal components of namespace
    $nhex = str_replace(array('-', '{', '}'), '', $namespace);
    // Binary Value
    $nstr = '';
    // Convert Namespace UUID to bits
    for ($i = 0; $i < strlen($nhex); $i += 2) {
      $nstr .= chr(hexdec($nhex[$i] . $nhex[$i + 1]));
    }
    // Calculate hash value
    $hash = sha1($nstr . $name);
    return sprintf('%08s-%04s-%04x-%04x-%12s',
            // 32 bits for "time_low"
            substr($hash, 0, 8),
            // 16 bits for "time_mid"
            substr($hash, 8, 4),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 5
            (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
            // 48 bits for "node"
            substr($hash, 20, 12)
    );
  }

  /**
   * Validates a given UUID
   * 
   * @param  string $uuid UUID to validate
   * @return bool
   */
  public static function isValid(string $uuid): bool {
    return preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid) === 1;
  }

}
