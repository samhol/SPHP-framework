<?php

/**
 * Arrays.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

/**
 * Utility class for PHP array operations
 * 
 * This class contains various methods for manipulating arrays (such as sorting 
 * and searching).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Arrays {

  /**
   * 
   * @param  mixed $needle
   * @param  array $haystack
   * @return boolean
   */
  public static function inArray($needle, $haystack) {
    $found = false;
    foreach ($haystack as $item) {
      if ($item === $needle) {
        $found = true;
        break;
      } elseif (is_array($item)) {
        $found = static::inArray($needle, $item);
        if ($found) {
          break;
        }
      }
    }
    return $found;
  }/**
 * @param mixed $input
 * @param null|callable $callback
 * @return array
 */
public static function filterRecursive($input, $callback = null) {
    if (!is_array($input)) {
        return $input;
    }
    if (null === $callback) {
        $callback = function ($v) { return !empty($v);};
    }
    $input = array_map(function($v) use ($callback) { return static::filterRecursive($v, $callback); }, $input);
    return array_filter($input, $callback);
}

  /**
   * 
   * @param array $array
   * @param callable $callback
   * @param type $userdata
   * @return array
   */
  public static function recursiveDelete(array &$array, callable $callback, $userdata = null) {
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
  public static function diff($array1, $array2) {
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
  public static function multiMap($callback, array $arr) {
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
  public static function implodeWithKeys(array $array, $separator = ', ', $glue = ' => ') {
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
  public static function valuesToKeys(array $array) {
    if (count($array) == 0) {
      return $array;
    }
    return array_combine($array, $array);
  }

  /**
   * Returns a single dimension array of random integers of given range 
   * 
   * @param  int $length the length of the array
   * @param  int $minValue the minimum value of a random number
   * @param  int $maxValue the maximum value of a random number
   * @return int[] array of random integers of given range 
   */
  public static function generateRandom($length, $minValue, $maxValue) {
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
      $arr[$i] = rand($minValue, $maxValue);
    }
    return $arr;
  }

  /**
   * Checks each key value pairs of the array against a rule defined in a 
   *  {@link \callable} 
   * 
   * @param  mixed[] $array the array to test
   * @param  \callable $rule the rule to test the array key value pair against
   * @return boolean true if the array passes the rule, otherwise false
   */
  public static function test(array $array, $rule) {
    foreach ($array as $key => $val) {
      if (!$rule($key, $val)) {
        return false;
      }
    }
    return true;
  }

  public static function getkeypath($arr, $lookup) {
    if (array_key_exists($lookup, $arr)) {
      return array($lookup);
    } else {
      foreach ($arr as $key => $subarr) {
        if (is_array($subarr)) {
          $ret = getkeypath($subarr, $lookup);
          if ($ret) {
            $ret[] = $key;
            return $ret;
          }
        }
      }
    }

    return null;
  }

  /**
   * Returns the value from an array using the key chain given as the second parameter
   * 
   * @param  mixed[] $array the array to search
   * @param  mixed|mixed[] $path the keychain 
   * @return mixed the value found or `null` if none was found
   */
  public static function getValue(array $array, $path) {
    $temp = &$array;
    foreach (is_array($path) ? $path : [$path] as $key) {
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
  public static function isLike(array $arr, $needle) {
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
  public static function keyContains(array $arr, $needle) {
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
  public static function isIndexed(array $arr) {
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
  public static function isSequential(array $arr, $base = 0) {
    for (reset($arr), $base = (int) $base; key($arr) === $base++; next($arr))
      ;
    return is_null(key($arr));
  }

  /**
   * Returns the input array values in a sequential array
   *
   * @param array $arr checked array
   * @param mixed $base the starting index of the sequence
   * @param int $step optional increment between elements in the sequence.
   * @return boolean true if conditions hold and false otherwise
   */
  public static function setSequential(array $arr, $base = 0, $step = 1) {
    if ($base == 0 && $step == 1) {
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
   * @param  $arr multidimensional array of strings to implode
   * @param  string $glue string between each array element
   * @param  string|null $lastGlue optional string between the last two array elements
   * @return string the imploded array
   */
  public static function implode(array $arr, $glue = "", $lastGlue = null) {
    if (is_null($lastGlue)) {
      $lastGlue = $glue;
    }
    $flat = self::flatten($arr);
    $length = count($flat);
    $output = "";
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
   * @param array $arr array to copy
   * @return array copied array
   * @link http://php.net/manual/en/language.oop5.cloning.php Object Cloning
   */
  public static function copy(array $arr) {
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
   * Flattens the multidimensional array to a single dimension
   *
   * **Notes:** The keys of the array are not preserved.
   *
   * @param  mixed[] $array
   * @return mixed[] the one dimensional result array
   */
  public static function flatten(array $array) {
    $newArray = [];
    foreach ($array as $child) {
      if (is_array($child)) {
        $newArray = array_merge($newArray, self::flatten($child));
      } else {
        $newArray[] = $child;
      }
    }
    return $newArray;
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

}
