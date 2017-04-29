<?php

/**
 * Filesystem.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\RuntimeException;
use SplFileObject;

/**
 * Tools to work with files and directories
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-08-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Filesystem {

  /**
   * 
   * @param  string $filename the file to test 
   * @return boolean
   */
  public static function isFile($filename) {
    $path = stream_resolve_include_path($filename);
    if ($path === false) {
      return false;
    } else {
      return is_file($path);
    }
  }

  /**
   * 
   * @param  string $path
   * @return string
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function getFullPath($path) {
    $fullPath = stream_resolve_include_path($path);
    if ($fullPath === false) {
      throw new RuntimeException("The path '$path' does not exist");
    }
    return $fullPath;
  }

  /**
   * Returns the entire file as a string
   *
   * @param  string $path the path to the file
   * @return string the result of the script execution
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public static function toString($path) {
    if (!static::isFile($path)) {
      throw new RuntimeException("The path '$path' contains no file");
    } else {
      $data = file_get_contents(static::getFullPath($path), false);
      if ($data === false) {
        throw new RuntimeException("Parsing the file '$path' failed");
      }
    }
    return file_get_contents($path, false);
  }

  /**
   * Executes a PHP script and returns the result as a string
   *
   * @param  string $paths the path to the executable PHP script
   * @return string the result of the script execution
   * @throws \Sphp\Exceptions\RuntimeException if the parsing fails for any reason
   */
  public static function executePhpToString($paths) {
    $content = '';
    try {
      ob_start();
      foreach (is_array($paths) ? $paths : [$paths] as $path) {
        if (!static::isFile($path)) {
          throw new RuntimeException("The path '$path' contains no executable PHP script");
        }
        include($path);
      }
      $content .= ob_get_contents();
    } catch (\Exception $e) {
      throw new RuntimeException("PHP parsing failed for $e", 0, $e);
    }
    ob_end_clean();
    return $content;
  }

  /**
   * Returns rows of the ASCII file in an array
   *
   * @param  string $path the path to the ASCII file
   * @return string[] rows of the ASCII file in an array
   * @throws \Sphp\Exceptions\RuntimeException if the $path points to no actual file
   */
  public static function getTextFileRows($path) {
    $result = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($result === false) {
      throw new RuntimeException("The path '$path' contains no file");
    }
    return $result;
  }

  /**
   * Returns the file/directory structure under the given path
   *
   * @param  string $dir
   * @return SplFileObject[] the file objects of the content files and directories
   */
  public static function dirToArray($dir, $sortingOrder = \SCANDIR_SORT_ASCENDING) {
    $contents = [];
    foreach (scandir($dir, $sortingOrder) as $node) {
      $path = "$dir/$node";
      if ($node == '.' || $node == '..') {
        continue;
      }
      if (is_dir($path)) {
        $contents[$path] = static::dirToArray($path, $sortingOrder);
      } else {
        $file = new SplFileObject($path);
        $key = pathinfo($node, PATHINFO_FILENAME);
        if (array_key_exists($key, $contents)) {
          $key = $node;
        }
        $contents[$key] = $file;
      }
    }
    return $contents;
  }

  /**
   * Returns the Mime type of the resource pointed by the given URL
   *
   * @param  string|URL $url the pointing to the resource
   * @return string the Mime type of the content pointed by the given URL
   */
  public static function getMimeType($url) {
    if ($url instanceof URL) {
      $url = $url->__toString();
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_exec($ch);
    return curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  }

  /**
   * Attempts to create the directory specified by pathname
   *
   * * For more information on modes, read the details on the {@link \chmod()} page.
   *
   * @param  string $path the directory path
   * @param  int $mode the mode is `0777` by default, which means the widest possible access
   * @return boolean true on success or false on failure
   * @link \mkdir()
   */
  public static function mkdir($path, $mode = 0777) {
    $result = is_dir($path);
    if (!$result) {
      $result = mkdir($path, $mode, true);
    }
    return $result;
  }

  /**
   * Attempts to create the file specified by pathname
   *
   * * For more information on modes, read the details on the {@link \chmod()} page.
   *
   * @param  string $path the file path
   * @param  int $mode the mode is `0777` by default, which means the widest possible access
   * @return boolean true on success or false on failure
   */
  public static function mkFile($path, $mode = 0777) {
    if (is_file($path)) {
      return false;
    }
    $dirname = dirname($path);
    if ($dirname !== '.' && !is_dir($dirname)) {
      static::mkdir($dirname, $mode);
    }
    return fopen($path, 'w') !== false;
  }

  /**
   * Converts the file size (in bits) to bytes
   *
   * @param  int|string $filesize file size in bits
   * @return string file size in bytes
   */
  public static function generateFilesizeString($filesize) {
    if (is_numeric($filesize)) {
      $decr = 1024;
      $step = 0;
      $prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
      while (($filesize / $decr) > 0.9) {
        $filesize = $filesize / $decr;
        $step++;
      }
      return round($filesize, 2) . ' ' . $prefix[$step];
    } else {
      return 'NaN';
    }
  }

}
