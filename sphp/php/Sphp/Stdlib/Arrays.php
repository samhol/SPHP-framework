<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Datastructures\Arrayable;
use Traversable;

/**
 * Utility class for PHP array operations
 * 
 * This class contains various methods for manipulating arrays (such as sorting 
 * and searching).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Arrays {

  /**
   * Sets the internal array pointer to the given key value pair 
   * 
   * @param  array $array the array to manipulate
   * @param  mixed $key the key of the new current element
   * @return array manipulated array 
   * @throws OutOfBoundsException if the key does not exist in the array
   */
  public static function pointToKey(array &$array, $key) {
    reset($array);
    while (!in_array(key($array), [$key, null], true)) {
      next($array);
    }
    if (key($array) === null) {
      throw new OutOfBoundsException("Key '$key' does not exist in the array");
    }
    return $array;
  }

  /**
   * Sets the internal array pointer to the given key value pair 
   * 
   * @param  array $array the array to manipulate
   * @param  mixed $value the value of the new current element
   * @return array manipulated array 
   * @throws OutOfBoundsException if the value does not exist in the array
   */
  public static function pointToValue(array &$array, $value) {
    $key = array_search($value, $array, true);
    if ($key === false) {
      throw new OutOfBoundsException("Value does not exist in the array");
    }
    return static::pointToKey($array, $key);
  }

  /**
   * Checks whether a value exists in the array
   * 
   * @param  mixed $needle the searched value
   * @param  array $haystack the array
   * @return boolean true if the value exist and false otherwise
   */
  public static function inArray($needle, array $haystack): bool {
    $found = false;
    foreach ($haystack as $item) {
      if ($item === $needle) {
        $found = true;
        break;
      } else if (is_array($item)) {
        $found = static::inArray($needle, $item);
        if ($found) {
          break;
        }
      }
    }
    return $found;
  }

  /**
   * 
   * 
   * @param  array $array
   * @param  null|callable $callback optional callback function 
   * @param  bool optional flag removal of empty arrays after filtering
   * @return array
   */
  public static function filterRecursive(array $array, $callback = null, bool $removeEmptyArrays = true): array {
    foreach ($array as $key => & $value) { // mind the reference
      if (is_array($value)) {
        $value = static::filterRecursive($value, $callback);
        if ($removeEmptyArrays && !(bool) $value) {
          unset($array[$key]);
        }
      } else {
        if (!is_null($callback) && !$callback($value)) {
          unset($array[$key]);
        } else if ($value === null) {
          unset($array[$key]);
        }
      }
    }
    unset($value); // kill the reference
    return $array;
  }

  /**
   * Determine if two associative arrays are similar
   *
   * Both arrays must have the same indexes with identical values
   * without respect to key ordering 
   * 
   * @param array $a
   * @param array $b
   * @return boolean true if similar and false otherwise
   */
  public static function similar(array $a, array $b): bool {
    // if the indexes don't match, return immediately
    if (count(array_diff_assoc($a, $b))) {
      return false;
    }
    // we know that the indexes, but maybe not values, match.
    // compare the values between the two arrays
    foreach ($a as $k => $v) {
      if ($v !== $b[$k]) {
        return false;
      }
    }
    // we have identical indexes, and no unequal values
    return true;
  }

  /**
   * Multidimensional array map
   * 
   * @param  \callable $callback Callback function to run for each element in 
   *         input array
   * @param  array $arr the input array
   * @return array an array containing all the elements of `$arr` after 
   *         applying the callback function to each one
   */
  public static function multiMap($callback, array $arr): array {
    $ret = [];
    foreach ($arr as $key => $val) {
      if (is_array($val)) {
        $ret[$key] = self::multiMap($callback, $val);
      } else {
        $ret[$key] = $callback($val);
      }
    }
    return $ret;
  }

  /**
   * Implode an array with the key and value pair giving a glue, a separator
   * between pairs and the array to implode.
   *
   * @param  string[] $array the array of strings to implode
   * @param  string $separator Separator between pairs
   * @param  string $glue the glue between key and value
   * @return string the imploded array
   */
  public static function implodeWithKeys(array $array, $separator = ', ', $glue = ' => '): string {
    $string = [];
    foreach ($array as $key => $val) {
      $string[] = "{$key}{$glue}{$val}";
    }
    return implode($separator, $string);
  }

  /**
   * Copies array's values to its keys
   *
   * **Notes:**
   *
   * * Illegal values for keys will be converted to strings
   *
   * @param  array $array the input array
   * @return array the result array
   * @link   http://php.net/array-combine PHP array_combine
   */
  public static function valuesToKeys(array $array): array {
    if (count($array) == 0) {
      return $array;
    }
    return array_combine($array, $array);
  }

  /**
   * Checks each key value pairs of the array against a rule defined in a 
   *  {@link \callable} 
   * 
   * @param  array $array the array to test
   * @param  \callable $rule the rule to test the array key value pair against
   * @return boolean true if the array passes the rule, otherwise false
   */
  public static function test(array $array, $rule): bool {
    foreach ($array as $key => $val) {
      if (!$rule($key, $val)) {
        return false;
      }
    }
    return true;
  }

  /**
   * Returns the value from an array using the key chain given as the second parameter
   * 
   * @param  array $array the array to search
   * @param  mixed|mixed[] $path the key chain (accepts multiple values)
   * @return mixed the value found or `null` if none was found
   */
  public static function getValue(array $array, ...$path) {
    $path = static::flatten($path);
    $temp = &$array;
    foreach ($path as $key) {
      $temp = & $temp[$key];
    }
    return $temp;
  }

  /**
   * Search an array for string values that contain the given phrase
   * 
   * @param  array $arr the array to search from
   * @param  string $needle the phrase to search for
   * @return string[] an array of values that contain the given phrase
   */
  public static function getValuesLike(array $arr, $needle): array {
    $strings = array_filter($arr, function($var) {
      return is_string($var) || is_numeric($var);
    });
    $searched = preg_quote($needle, '/');
    $input = preg_quote($searched, '~'); // don't forget to quote input string!
    return preg_grep('~' . $input . '~', $strings);
  }

  /**
   * Search a single dimensional array for keys that contain the given phrase
   * 
   * @param  string[] $arr the array to search from
   * @param  string $needle the phrase to search for
   * @return string[] an array of values that have the matching keys
   */
  public static function findKeysLike(array $arr, $needle): array {
    $keys = array_keys($arr);
    $passed = self::getValuesLike($keys, $needle);
    $result = [];
    foreach ($passed as $key) {
      $result[$key] = $arr[$key];
    }
    return $result;
  }

  /**
   * Checks if each key is an integer value
   *
   * @param array $arr checked array
   * @return boolean true if array is indexed and false otherwise
   */
  public static function isIndexed(array $arr): bool {
    for (reset($arr); is_int(key($arr)); next($arr))
      ;
    return is_null(key($arr));
  }

  /**
   * Checks if each key is an integer value and if all keys are in sequential
   * order starting at $base
   *
   * @param array $arr checked array
   * @param int|null $base the starting index of the sequence
   * @return boolean true if conditions hold and false otherwise
   */
  public static function isSequential(array $arr, int $base = null): bool {
    if ($base === null) {
      $base = key($arr);
    }
    for (reset($arr); key($arr) === $base++; next($arr))
      ;
    return is_null(key($arr));
  }

  /**
   * Returns the input array values in a sequential array
   *
   * @param  array $arr checked array
   * @param  int $base the starting index of the sequence
   * @return array sequential array
   */
  public static function setSequential(array $arr, int $base = 0): array {
    if ($base === 0) {
      $result = array_values($arr);
    } else {
      $sequence = range($base, count($arr) + $base - 1);
      $result = array_combine($sequence, $arr);
    }
    return $result;
  }

  /**
   * Implodes all elements of an (optionally multidimensional) array with a string
   *
   * **Notes:**
   * 
   * * Supports multidimensional arrays.
   * * Returns a string containing a string representation of all the array 
   *   elements in the same order, with the $glue string between each element.
   * 
   * @param  array $arr multidimensional array of strings to implode
   * @param  string $glue string between each array element
   * @return string the imploded array
   * @throws InvalidArgumentException if the array cannot be converted to string
   */
  public static function recursiveImplode(array $arr, string $glue = ''): string {
    $output = '';
    static::flatten($arr);
    foreach ($arr as $value) {
      if (is_scalar($value) || $value === null) {
        $output .= $glue . $value;
      } else if (is_object($value)) {
        if (method_exists($value, '__toString')) {
          $output .= $glue . $value;
        } else if ($value instanceof \Traversable) {
          $output .= $glue . static::recursiveImplode(iterator_to_array($value), $glue);
        } else {
          throw new InvalidArgumentException('Object ' . get_class($value) . ' has no string representation');
        }
      } else if (is_array($value)) {
        $output .= $glue . static::recursiveImplode($value, $glue);
      } else {
        throw new InvalidArgumentException('value ' . gettype($value) . ' has no string representation');
      }
    }
    return $output;
  }

  /**
   * Copies all the values of an array to a result array
   *
   * **Notes**
   *
   * * Works also on multidimensional arrays
   * * Clones all objects stored in $arr using PHP's clone keyword.
   *
   * @param  array $arr array to copy
   * @return array copied array
   * @link   http://php.net/manual/en/language.oop5.cloning.php Object Cloning
   */
  public static function copy(array $arr): array {
    $newArray = [];
    foreach ($arr as $key => $value) {
      if (is_array($value)) {
        $newArray[$key] = static::copy($value);
      } else if (is_object($value)) {
        $newArray[$key] = clone $value;
      } else {
        $newArray[$key] = $value;
      }
    }
    return $newArray;
  }

  /**
   * Returns the values of an input array in a single dimension array 
   *
   * **Notes:** The keys of the array are not preserved.
   *
   * @param  array $array multi-dimensional array
   * @return array the one dimensional result array
   */
  public static function flatten(array $array): array {
    $return = [];
    array_walk_recursive($array, function($a) use (&$return) {
      $return[] = $a;
    });
    return $return;
  }

  /**
   * 
   * @param  mixed $object
   * @return array
   * @throws InvalidArgumentException if the type cannot be transformed to an array
   */
  public static function toArray($object): array {
    if (is_array($object)) {
      return $object;
    }
    if (!is_object($object)) {
      throw new InvalidArgumentException('Object or array required: ' . gettype($object) . ' given');
    }
    if ($object instanceof Arrayable) {
      $items = $object->toArray();
    } else if ($object instanceof Traversable) {
      $items = iterator_to_array($object);
    } else {
      throw new InvalidArgumentException('object cannot be transformed to an array');
    }
    return $items;
  }

}
