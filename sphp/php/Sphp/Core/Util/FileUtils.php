<?php

/**
 * FileUtils.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Util;

use InvalidArgumentException;

/**
 * Class contains tools to work with files and directories
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-08-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FileUtils {

  /**
   * Returns the entire file as a string
   *
   * @param  string $path the path to the file
   * @return string the result of the script execution
   * @throws InvalidArgumentException if the $path points to no actual file
   */
  public static function fileToString($path) {
    if (!is_file($path)) {
      throw new InvalidArgumentException("The path '$path' contains no file");
    }
    return file_get_contents($path, false);
  }

  /**
   * Executes a PHP script and returns the result as a string
   *
   * @param  string $page the path to the executable PHP script
   * @return string the result of the script execution
   */
  public static function executePhpToString($page) {
    $content = "";
    try {
      ob_start();
      if (!is_file($page)) {
        throw new InvalidArgumentException('the path given contains no executable PHP script');
      }
      include($page);
      $content .= ob_get_contents();
    } catch (\Exception $e) {
      $content .= $e;
    }
    ob_end_clean();
    return $content;
  }

  /**
   * Returns rows of the ascii file in an array
   *
   * @param  string $filename the path to the ascii file
   * @return string[] rows of the ascii file in an array
   * @throws \InvalidArgumentException if the $filename points to no actual file
   */
  public static function getTextFileRows($filename) {
    $result = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($result === false) {
      throw new \InvalidArgumentException('the path given contains no file');
    }
    return $result;
  }

  /**
   * Returns the names of the content files of a directory
   *
   * @param  string $dir
   * @return string[] the file names of the content files and directories
   */
  public static function dirToArray($dir) {
    $contents = array();
    foreach (scandir($dir) as $node) {
      if ($node == '.' || $node == '..') {
        continue;
      }
      if (is_dir($dir . '/' . $node)) {
        $contents[$node] = self::dirToArray($dir . '/' . $node);
      } else {
        $contents[] = $node;
      }
    }
    return $contents;
  }

  /**
   * Executes a PHP script and returns the result as a parsed Markdown string
   *
   * @param  string $md the path to the executable PHP script
   * @return string the result of the script execution
   */
  public static function parseYaml($path) {
    return Parser::parseYamlString(static::fileToString($path));
  }
  /**
   * Checks whether the remote file exists or not
   *
   * @param  string $url the path to the remote file
   * @return boolean true if the remote file exists and false otherwise
   */
  public static function remoteFileExists($url) {
    if ($url instanceof URL) {
      $url = $url->__toString();
    }
    $url_data = parse_url($url);
    if (!$url_data || !isset($url_data['host'])) {
      return false;
    }
    $errno = '';
    $errstr = '';
    $fp = fsockopen($url_data['host'], 80, $errno, $errstr, 30);
    if ($fp === false) {
      return false;
    }
    $path = "";
    if (isset($url_data['path'])) {
      $path .= $url_data['path'];
    }
    if (isset($url_data['query'])) {
      $path .= '?' . $url_data['query'];
    }
    $out = "GET /$path HTTP/1.1\r\n";
    $out .= "Host: {$url_data['host']}\r\n";
    $out .= "Connection: Close\r\n\r\n";
    fwrite($fp, $out);
    $content = fgets($fp);
    $code = trim(substr($content, 9, 4));
    fclose($fp);
    return ($code[0] == 2 || $code[0] == 3) ? true : false;
  }

  /**
   * Returns the Mime type of the resource pointed by the given url
   *
   * @param  string|URL $url the pointing to the resource
   * @return string mimetype of the content pointed by the given url
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
   * @param  string $pathname the directory path
   * @param  int $mode the mode is `0777` by default, which means the widest possible access
   * @return boolean true on success or false on failure
   * @link \mkdir()
   */
  public static function mkdir($pathname, $mode = 0777) {
    $result = file_exists($pathname);
    if (!$result) {
      $result = mkdir($pathname, $mode, true);
    }
    return $result;
  }

  /**
   * Converts the filesize (in bits) to bytes
   *
   * @param  int|string $filesize file size in bits
   * @return string filesize in bytes
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
