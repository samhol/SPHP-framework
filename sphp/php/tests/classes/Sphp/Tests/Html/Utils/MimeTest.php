<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Utils;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Utils\Mime;

/**
 * Class MimeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MimeTest extends TestCase {

  private function getMap(): array {
    return [
        'aac' => ['audio/aac', 'audio'],
        'abw' => ['application/x-abiword', null],
        'arc' => ['application/x-freearc', null],
        'avi' => ['video/x-msvideo', 'video'],
        'azw' => ['application/vnd.amazon.ebook', null],
        'bin' => ['application/octet-stream', null],
        'bmp' => ['image/bmp', 'image'],
        'bz' => ['application/x-bzip', null],
        'bz2' => ['application/x-bzip2', null],
        'csh' => ['application/x-csh', null],
        'css' => ['text/css', 'stylesheet'],
        'csv' => ['text/csv', null],
        'doc' => ['application/msword', null],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', null],
        'eot' => ['application/vnd.ms-fontobject', null],
        'epub' => ['application/epub+zip', null],
        'gz' => ['application/gzip', null],
        'gif' => ['image/gif', 'image'],
        'htm' => ['text/html', null],
        'html' => ['text/html', null],
        'ico' => ['image/vnd.microsoft.icon', 'image'],
        'ics' => ['text/calendar', null],
        'jar' => ['application/java-archive', null],
        'jpeg' => ['image/jpeg', 'image'],
        'jpg' => ['image/jpeg', 'image'],
        'js' => ['text/javascript', 'script'],
        'json' => ['application/json', null],
        'jsonld' => ['application/ld+json', null],
        'mid' => ['audio/midi audio/x-midi', 'audio'],
        'midi' => ['audio/midi audio/x-midi', 'audio'],
        'mjs' => ['text/javascript', null],
        'mp3' => ['audio/mpeg', 'audio'],
        'mpeg' => ['video/mpeg', 'video'],
        'mp4' => ['video/mp4', 'video'],
        'mpkg' => ['application/vnd.apple.installer+xml', null],
        'odp' => ['application/vnd.oasis.opendocument.presentation', null],
        'ods' => ['application/vnd.oasis.opendocument.spreadsheet', null],
        'odt' => ['application/vnd.oasis.opendocument.text', null],
        'oga' => ['audio/ogg', 'audio'],
        'ogv' => ['video/ogg', 'video'],
        'ogx' => ['application/ogg', null],
        'opus' => ['audio/opus', 'audio'],
        'otf' => ['font/otf', 'font'],
        'png' => ['image/png', 'image'],
        'pdf' => ['application/pdf', null],
        'php' => ['application/x-httpd-php', null],
        'ppt' => ['application/vnd.ms-powerpoint', null],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation', null],
        'rar' => ['application/vnd.rar', null],
        'rtf' => ['application/rtf', null],
        'sh' => ['application/x-sh', null],
        'svg' => ['image/svg+xml', 'image'],
        'swf' => ['application/x-shockwave-flash', null],
        'tar' => ['application/x-tar', null],
        'tif' => ['image/tiff', 'image'],
        'tiff' => ['image/tiff', 'image'],
        'ts' => ['video/mp2t', 'video'],
        'vsd' => ['application/vnd.visio', null],
        'wav' => ['audio/wav', 'audio'],
        'weba' => ['audio/webm', 'audio'],
        'webm' => ['video/webm', 'video'],
        'webp' => ['image/webp', 'image'],
        'woff' => ['font/woff', 'font'],
        'woff2' => ['font/woff2', 'font'],
        'ttf' => ['font/ttf', 'font'],
        'txt' => ['text/plain', 'font'],
        'xhtml' => ['application/xhtml+xml', null],
        'xls' => ['application/vnd.ms-excel', null],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null],
        'xml' => ['text/xml', null],
        'xul' => ['application/vnd.mozilla.xul+xml', null],
        'zip' => ['application/zip', null],
        '3gp' => ['video/3gpp', 'video'],
        '3g2' => ['video/3gpp2', 'video'],
        '7z' => ['application/x-7z-compressed', null],
    ];
  }

  /**
   * @return void
   */
  public function testGetMime(): void {
    foreach ($this->getMap() as $ext => $data) {
      $this->assertSame($data[0], Mime::getMime("/foo.$ext"));
      $this->assertSame($data[1], Mime::getContentType("/foo.$ext"));
    }
    $this->assertNull(Mime::getMime('/foo.bar'));
    $this->assertNull(Mime::getContentType('/foo.bar'));
  }

}
