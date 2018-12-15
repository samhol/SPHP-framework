<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\FileSystemException;
use Sphp\Stdlib\Arrays;
use Exception;
use SplFileInfo;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Tools to work with files and directories
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Filesystem {

  /**
   * Checks whether the file exists and is an actual file
   * 
   * @param  string $filename the file to test 
   * @return boolean true if the pile path point to a file
   */
  public static function isFile(string $filename): bool {
    $path = stream_resolve_include_path($filename);
    if ($path === false) {
      return false;
    } else {
      return is_file($path);
    }
  }

  /**
   * Solves the full path to file
   * 
   * @param  string $path  relative path to file
   * @return string full path to file
   * @throws FileSystemException if the file path cannot be resolved
   */
  public static function getFullPath(string $path): string {
    $fullPath = stream_resolve_include_path($path);
    if ($fullPath === false) {
      throw new FileSystemException("The path '$path' does not exist");
    }
    return $fullPath;
  }

  /**
   * Returns the entire file as a string
   *
   * @param  string $path the path to the file
   * @return string the result of the script execution
   * @throws FileSystemException if the parsing fails for any reason
   */
  public static function toString(string $path): string {
    $data = file_get_contents(static::getFullPath($path), false);
    if ($data === false) {
      throw new FileSystemException("Parsing the file '$path' failed");
    }
    return $data;
  }

  /**
   * Executes a PHP script and returns the result as a string
   *
   * **Important:**
   * 
   * if the executed php file has any side-effects it could mutate the state of 
   * the application even though it is not sending output to the browser.
   * 
   * @param  string|string[],... $paths the path to the executable PHP script
   * @return string the result of the script execution
   * @throws FileSystemException if the $paths points to no actual file
   * @throws Exception 
   */
  public static function executePhpToString(...$paths): string {
    $content = '';
    ob_start();
    foreach (Arrays::flatten($paths) as $path) {
      if (!static::isFile($path)) {
        ob_end_clean();
        throw new FileSystemException("The path '$path' contains no executable PHP script");
      }
      include($path);
    }
    $content .= ob_get_contents();

    ob_end_clean();
    return $content;
  }

  /**
   * Returns rows of the ASCII file in an array
   *
   * @param  string $path the path to the ASCII file
   * @return string[] rows of the ASCII file in an array
   * @throws FileSystemException if the $path points to no actual file
   */
  public static function getTextFileRows(string $path): array {
    $result = file(static::getFullPath($path), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($result === false) {
      throw new FileSystemException("The path '$path' contains no readable file");
    }
    return $result;
  }

  /**
   * Attempts to create the directory specified by pathname
   *
   * @param  string $path the directory path
   * @param  int $mode the mode is `0777` by default, which means the widest possible access
   * @return SplFileInfo file info object pointing to the folder
   * @throws FileSystemException if the operation fails
   */
  public static function mkdir(string $path, int $mode = 0777): SplFileInfo {
    $thrower = new ErrorToExceptionThrower(FileSystemException::class);
    $thrower->start();
    $fileinfo = new SplFileInfo($path);
    //$realPath = $fileinfo->getRealPath();
    if (!$fileinfo->isDir()) {
      if (!mkdir($path, $mode, true)) {
        throw new FileSystemException("Directory path '$path' cannot be created");
      }
    }
    if ($fileinfo->getPerms() !== $mode) {

      $result = chmod($fileinfo->getRealPath(), $mode);
      if (!$result) {
        throw new FileSystemException("Permission cannot be set");
      }
    }
    $thrower->stop();
    return $fileinfo;
  }

  /**
   * Attempts to create the file specified by pathname
   *
   * @param  string $path the file path
   * @param  int $mode the mode is `0777` by default, which means the widest possible access
   * @return SplFileInfo file info object pointing to the file
   * @throws FileSystemException if the file creation fails
   */
  public static function mkFile(string $path, int $mode = 0777): SplFileInfo {
    $fileinfo = new SplFileInfo($path);
    $dirname = $fileinfo->getPath();
    if ($dirname !== '.' && !is_dir($dirname)) {
      static::mkdir($dirname, $mode);
    }
    if (!$fileinfo->isWritable()) {
      $success = fopen($path, 'w') !== false;
      if (!$success) {
        throw new FileSystemException("File '$path' cannot be created");
      }
    }
    return $fileinfo;
  }

  /**
   * 
   * @param string $path
   * @return SplFileInfo
   */
  public static function rmDir(string $path): SplFileInfo {
    $fileinfo = new SplFileInfo($path);
    if ($fileinfo->isDir()) {
      rmdir($path);
    }
    return $fileinfo;
  }

  public static function rmFile(string $path): SplFileInfo {
    $fileinfo = new SplFileInfo($path);
    if ($fileinfo->isFile()) {
      unlink($fileinfo->getRealPath());
    }
    return $fileinfo;
  }

}
