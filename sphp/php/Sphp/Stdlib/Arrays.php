<?php

/**
 * Arrays.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\OutOfBoundsException;

/**
 * Utility class for PHP array operations
 * 
 * This class contains various methods for manipulating arrays (such as sorting 
 * and searching).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Arrays {

  /**
   * Sets the internal array pointer to the given key value pair 
   * 
   * @param  array $array the array to manipulate
   * @param  mixed $key the key of the new current element
   * @return array manipulated array 
   * @throws \Sphp\Exceptions\OutOfBoundsException if the key does not exist in the array
   */
  public static function pointToKey(array &$array, $key) {
    reset($array);
    while (!in_array(key($array), [$key, null])) {
      next($array);
    }
    if (current($array) === false) {
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
   * @throws \Sphp\Exceptions\OutOfBoundsException if the value does not exist in the array
   */
  public static function pointToValue(array &$array, $value) {
    reset($array);
    while (!in_array(current($array), [$value, null])) {
      next($array);
    }
    if (current($array) !== false) {
      throw new OutOfBoundsException("Value '$value' does not exist in the array");
    }
    return $array;
  }

  /**
   * 
   * @param  array $array
   * @param  mixed $current
   * @return mixed
   */
  public static function next(array &$array, $current) {
    reset($array);
    $next = current($array);
    do {
      $tmp_val = current($array);
      $res = next($array);
    } while (($tmp_val != $current) && $res);
    if ($res) {
      $next = current($array);
    }
    return $next;
  }

  /**
   * 
   * @param  array $array
   * @param  mixed $current
   * @return mixed
   */
  public static function prev(&$array, $current) {
    end($array);
    $prev = current($array);
    do {
      $tmp_val = current($array);
      $res = prev($array);
    } while (($tmp_val != $current) && $res);
    if ($res) {
      $prev = current($array);
    }
    return $prev;
  }

  /**
   * 
   * @param  mixed $needle
   * @param  array $haystack
   * @return boolean
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
   * @param mixed $input
   * @param null|callable $callback
   * @return array
   */
  public static function filterRecursive($input, $callback = null) {
    if (!is_array($input)) {
      return $input;
    }
    if (null === $callback) {
      $callback = function ($v) {
        return !empty($v);
      };
    }
    $input = array_map(function($v) use ($callback) {
      return static::filterRecursive($v, $callback);
    }, $input);
    return array_filter($input, $callback);
  }

  /**
   * 
   * @param array $array
   * @param callable $callback
   * @param type $userdata
   * @return array
   */
  public static function recursiveDelete(array &$array, callable $callback, $userdata = null): array {
    foreach ($array as $key => &$value) {
      if (is_array($value)) {
        $value = static::recursiveDelete($value, $callback, $userdata);
      }
      if ($callback($value, $key, $userdata)) {
        unset($array[$key]);
      }
    }

    return $array;
  }

  /**
   * Computes the full difference of arrays
   *
   * @param  array $array1 the first array to compare
   * @param  array $array2 the second array to compare
   * @return array the full difference between the input arrays
   */
  public static function diff($array1, $array2): array {
    $aReturn = array();

    foreach ($array1 as $mKey => $mValue) {
      if (array_key_exists($mKey, $array2)) {
        if (is_array($mValue)) {
          $aRecursiveDiff = static::diff($mValue, $array2[$mKey]);
          if (count($aRecursiveDiff)) {
            $aReturn[$mKey] = $aRecursiveDiff;
          }
        } else {
          if ($mValue !== $array2[$mKey]) {
            $aReturn[$mKey] = $mValue;
          }
        }
      } else {
        $aReturn[$mKey] = $mValue;
      }
    }

    return $aReturn;
  }

  /**
   * Multidimensional array map
   * 
   * @param  \callable $callback Callback function to run for each element in 
   *         input array
   * @param  mixed[] $arr the input array
   * @return mixed[] an array containing all the elements of `$arr` after 
   *         applying the callback function to each one
   */
  public static function multiMap($callback, array $arr): array {
    $ret = [];
    foreach ($arr as $key => $val) {
      $ret[$key] = (is_array($val) ? self::multiMap($callback, $val) : $callback($val));
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
   * Search a single dimensional array for values that contain the given phrase
   * 
   * @param  string[] $arr the array to search from
   * @param  string $needle the phrase to search for
   * @return string[] an array of values that contain the given phrase
   */
  public static function isLike(array $arr, $needle): array {
    $searched = preg_quote($needle, '/');
    $input = preg_quote($searched, '~'); // don't forget to quote input string!
    return preg_grep('~' . $input . '~', $arr);
  }

  /**
   * Search a single dimensional array for keys that contain the given phrase
   * 
   * @param  string[] $arr the array to search from
   * @param  string $needle the phrase to search for
   * @return string[] an array of values that have the matching keys
   */
  public static function keyContains(array $arr, $needle): array {
    $keys = array_keys($arr);
    $passed = self::isLike($keys, $needle);
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
   * @param int $base the starting index of the sequence
   * @return boolean true if conditions hold and false otherwise
   */
  public static function isSequential(array $arr, int $base = 0): bool {
    for (reset($arr), $base = $base; key($arr) === $base++; next($arr))
      ;
    return is_null(key($arr));
  }

  /**
   * Returns the input array values in a sequential array
   *
   * @param  array $arr checked array
   * @param  int $base the starting index of the sequence
   * @param  int $step optional increment between elements in the sequence.
   * @return array sequential array
   */
  public static function setSequential(array $arr, int $base = 0, int $step = 1): array {
    if ($base === 0 && $step === 1) {
      $result = array_values($arr);
    } else {
      $sequence = range($base, count($arr), $step);
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
   * * Inserts the optional $lastGlue string between the last two elements if 
   *   given. (Otherwise uses the $glue string)
   * 
   * @param  array $arr multidimensional array of strings to implode
   * @param  string $glue string between each array element
   * @param  string|null $lastGlue optional string between the last two array elements
   * @return string the imploded array
   */
  public static function implode(array $arr, string $glue = '', string $lastGlue = null): string {
    if (is_null($lastGlue)) {
      $lastGlue = $glue;
    }
    $flat = self::flatten($arr);
    $length = count($flat);
    $output = '';
    if ($length > 2) {
      for ($i = 0; $i < $length - 2; ++$i) {
        $output .= Strings::toString(array_shift($flat)) . $glue;
      }
      $output .= Strings::toString(array_shift($flat))
              . $lastGlue . Strings::toString(array_shift($flat));
    } else if ($length == 2) {
      $output = Strings::toString(array_shift($flat))
              . $lastGlue . Strings::toString(array_shift($flat));
    } else if ($length == 1) {
      $output = Strings::toString(array_shift($flat));
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
        $newArray[$key] = self::copy($value);
      } else if (is_object($value)) {
        $newArray[$key] = clone $value;
      } else {
        $newArray[$key] = $value;
      }
    }
    return $newArray;
  }

  /**
   * Flattens the given multidimensional array to a single dimension
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

}
