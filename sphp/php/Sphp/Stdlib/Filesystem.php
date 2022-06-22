<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Exceptions\FileSystemException;
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
   * @return bool true if the pile path point to a file
   */
  public static function isFile(string $filename): bool {
    $isFile = is_file($filename);
    if (!$isFile) {
      $path = stream_resolve_include_path($filename);
      if ($path) {
        $isFile = is_file($filename);
      }
    }
    return $isFile;
  }

  public static function isAsciiFile(string $filename): bool {
    $isAscii = false;
    if (static::isFile($filename)) {
      $finfo = new \finfo(\FILEINFO_MIME);
      $mime = $finfo->file($filename);
      $isAscii = substr($mime, 0, 4) === 'text' ||
              str_contains($mime, 'charset=utf-8') ||
              str_contains($mime, 'charset=us-ascii');
    }
    return $isAscii;
  }

  /**
   * Returns the entire file as a string
   *
   * @param  string $path the path to the file
   * @return string the result of the script execution
   * @throws FileSystemException if the parsing fails for any reason
   */
  public static function toString(string $path): string {
    if (!self::isFile($path)) {
      throw new FileSystemException("Parsing the file '$path' failed");
    }
    $data = file_get_contents($path, false, null, 0);
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
   * @param  string $path the path to the executable PHP script
   * @return string the result of the script execution
   * @throws FileSystemException if the $paths points to no actual file 
   */
  public static function executePhpToString(string $path): string {
    if (!is_file($path)) {
      throw new FileSystemException("The path '$path' contains no readable file");
    }
    $thrower = new ErrorToExceptionThrower(FileSystemException::class);
    $thrower->start(\E_ALL);
    $content = '';
    $level = ob_get_level();
    try {
      ob_start();
      include($path);
      $content .= ob_get_clean();
      while ($level < ob_get_level()) {
        ob_end_clean();
      }
    } catch (\Throwable $ex) {
      while ($level < ob_get_level()) {
        ob_end_clean();
      }
      $thrower->stop();
      throw new FileSystemException($ex->getMessage(), $ex->getCode(), $ex);
    }
    $thrower->stop();
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
    if (!is_file($path)) {
      throw new FileSystemException("The path '$path' contains no readable file");
    }
    $result = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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
