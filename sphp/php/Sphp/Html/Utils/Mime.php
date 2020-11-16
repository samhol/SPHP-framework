<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Utils;

/**
 * Class Mime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Mime {

  private static $map = [
      'aac' => ['audio/aac', 'audio'],
      'abw' => ['application/x-abiword',],
      'arc' => ['application/x-freearc',],
      'avi' => ['video/x-msvideo', 'video'],
      'azw' => ['application/vnd.amazon.ebook',],
      'bin' => ['application/octet-stream',],
      'bmp' => ['image/bmp', 'image'],
      'bz' => ['application/x-bzip',],
      'bz2' => ['application/x-bzip2',],
      'csh' => ['application/x-csh',],
      'css' => ['text/css', 'stylesheet'],
      'csv' => ['text/csv',],
      'doc' => ['application/msword',],
      'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document',],
      'eot' => ['application/vnd.ms-fontobject',],
      'epub' => ['application/epub+zip',],
      'gz' => ['application/gzip',],
      'gif' => ['image/gif', 'image'],
      'htm' => ['text/html',],
      'html' => ['text/html',],
      'ico' => ['image/vnd.microsoft.icon', 'image'],
      'ics' => ['text/calendar',],
      'jar' => ['application/java-archive',],
      'jpeg' => ['image/jpeg', 'image'],
      'jpg' => ['image/jpeg', 'image'],
      'js' => ['text/javascript', 'script'],
      'json' => ['application/json',],
      'jsonld' => ['application/ld+json',],
      'mid' => ['audio/midi audio/x-midi', 'audio'],
      'midi' => ['audio/midi audio/x-midi', 'audio'],
      'mjs' => ['text/javascript',],
      'mp3' => ['audio/mpeg', 'audio'],
      'mpeg' => ['video/mpeg', 'video'],
      'mp4' => ['video/mp4', 'video'],
      'mpkg' => ['application/vnd.apple.installer+xml',],
      'odp' => ['application/vnd.oasis.opendocument.presentation',],
      'ods' => ['application/vnd.oasis.opendocument.spreadsheet',],
      'odt' => ['application/vnd.oasis.opendocument.text',],
      'oga' => ['audio/ogg', 'audio'],
      'ogv' => ['video/ogg', 'video'],
      'ogx' => ['application/ogg',],
      'opus' => ['audio/opus', 'audio'],
      'otf' => ['font/otf', 'font'],
      'png' => ['image/png', 'image'],
      'pdf' => ['application/pdf',],
      'php' => ['application/x-httpd-php',],
      'ppt' => ['application/vnd.ms-powerpoint',],
      'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation',],
      'rar' => ['application/vnd.rar',],
      'rtf' => ['application/rtf',],
      'sh' => ['application/x-sh',],
      'svg' => ['image/svg+xml', 'image'],
      'swf' => ['application/x-shockwave-flash',],
      'tar' => ['application/x-tar',],
      'tif' => ['image/tiff', 'image'],
      'tiff' => ['image/tiff', 'image'],
      'ts' => ['video/mp2t', 'video'],
      'vsd' => ['application/vnd.visio',],
      'wav' => ['audio/wav', 'audio'],
      'weba' => ['audio/webm', 'audio'],
      'webm' => ['video/webm', 'video'],
      'webp' => ['image/webp', 'image'],
      'woff' => ['font/woff', 'font'],
      'woff2' => ['font/woff2', 'font'],
      'ttf' => ['font/ttf', 'font'],
      'txt' => ['text/plain', 'font'],
      'xhtml' => ['application/xhtml+xml',],
      'xls' => ['application/vnd.ms-excel',],
      'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',],
      'xml' => ['text/xml'],
      'xul' => ['application/vnd.mozilla.xul+xml'],
      'zip' => ['application/zip'],
      '3gp' => ['video/3gpp', 'video'],
      '3g2' => ['video/3gpp2', 'video'],
      '7z' => ['application/x-7z-compressed'],
  ]; 

  public static function getMime(string $path): ?string {
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $mime = null;
    if (array_key_exists("$ext", self::$map)) {
      $mime = self::$map["$ext"][0];
    }
    return $mime;
  }

  public static function getContentType(string $path): ?string {
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $type = null;
    if (array_key_exists("$ext", self::$map) && array_key_exists(1, self::$map[$ext])) {
      $type = self::$map["$ext"][1];
    }
    return $type;
  }

}
