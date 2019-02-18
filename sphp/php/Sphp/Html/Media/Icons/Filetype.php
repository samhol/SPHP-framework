<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use SplFileInfo;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * File type icon factory
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon facebookSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon twitterSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon googlePlusSquare(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon java(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon jar(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon class(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon php3(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon phtml(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon phar(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\FaIcon js(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\FaIcon json(string $screenReaderLabel = null) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Filetype {

  /**
   * @var string[] 
   */
  private static $fileTypeMap = [
      'csv' => 'text',
      'db' => 'database',
      'dbf' => 'database',
      'mdb' => 'database',
      'sql' => 'database',
      /**
       * HTML related:
       */
      'xhtml' => 'code',
      'txt' => 'text',
      'md' => 'code',
      'css' => 'css',
      'html' => 'code',
      'htmls' => 'code',
      'shtml' => 'code',
      'htm' => 'code',
      'cer' => 'certificate',
      /**
       * JavaScript:
       */
      'js' => 'js',
      'json' => 'js',
      /**
       * C++:
       */
      'cpp' => 'c++',
      'cc' => 'cpp',
      /**
       * Visual C#:
       */
      'cs' => 'c#',
      /**
       * PHP:
       */
      'php' => 'php',
      'php3' => 'php',
      'phtml' => 'php',
      'phar' => 'php',
      /**
       * ASP:
       */
      'asp' => 'code',
      'aspx' => 'code',
      /**
       * Program code:
       */
      'vb' => 'code',
      'bat' => 'executable',
      'bin' => 'java',
      'cgi' => 'code',
      'pl' => 'code',
      'com' => 'executable',
      'exe' => 'executable',
      'jar' => 'java',
      'py' => 'python',
      'wsf' => 'windows',
      'gadget' => 'windows',
      'xml' => 'code',
      'htx' => 'code',
      'rss' => 'code',
      'rexx' => 'code',
      /**
       * Java files:
       */
      'java' => 'java',
      'class' => 'java',
      'jsp' => 'java',
      'jav' => 'java',
      /**
       * Text:
       */
      'mcf' => 'text',
      'pas' => 'text',
      'lst' => 'text',
      'com' => 'text',
      'conf' => 'text',
      'def' => 'text',
      'cxx' => 'text',
      'txt' => 'text',
      'log' => 'text',
      'list' => 'text',
      'c' => 'c',
      'text' => 'text',
      'idc' => 'text',
      'rtf' => 'text',
      'rtx' => 'text',
      'wsc' => 'text',
      'tsv' => 'text',
      'uri' => 'text',
      'uni' => 'text',
      'uris' => 'text',
      'unis' => 'text',
      'abc' => 'text',
      'flx' => 'text',
      'rt' => 'text',
      'wml' => 'text',
      'wmls' => 'text',
      'htt' => 'text',
      'asm' => 'text',
      's' => 'text',
      'aip' => 'text',
      'htc' => 'text',
      'f90' => 'text',
      'for' => 'code',
      'h' => 'c',
      'hh' => 'text',
      'lsx' => 'text',
      'm' => 'text',
      'p' => 'text',
      'hlb' => 'text',
      'csh' => 'text',
      'el' => 'text',
      'ksh' => 'text',
      'lsp' => 'text',
      'pm' => 'text',
      'sh' => 'text',
      'tcl' => 'text',
      'ssi' => 'code',
      'etx' => 'text',
      'sgm' => 'text',
      'sgml' => 'code',
      'talk' => 'text',
      'spc' => 'text',
      'uil' => 'text',
      'uue' => 'text',
      'uu' => 'text',
      'vcs' => 'text',
      /**
       * Video:
       */
      'h264' => 'video',
      'afl' => 'video',
      'avs' => 'video',
      'm2v' => 'video',
      'm1v' => 'video',
      'mpe' => 'video',
      'mpa' => 'video',
      'mpg' => 'video',
      'mpeg' => 'video',
      'mp4' => 'video',
      'qt' => 'video',
      'moov' => 'video',
      'mov' => 'video',
      'vdo' => 'video',
      'rv' => 'video',
      'vivo' => 'video',
      'viv' => 'video',
      'vos' => 'video',
      'xdr' => 'video',
      'xsr' => 'video',
      'fmf' => 'video',
      'dl' => 'video',
      'dv' => 'video',
      'dif' => 'video',
      'fli' => 'video',
      'gl' => 'video',
      'isu' => 'video',
      'mjpg' => 'video',
      'mp3' => 'video',
      'mp2' => 'video',
      'asf' => 'video',
      'asx' => 'video',
      'avi' => 'video',
      'qtc' => 'video',
      'scm' => 'video',
      'mv' => 'video',
      'movie' => 'video',
      'vob' => 'video',
      'wmv' => 'video',
      'swf' => 'video',
      'mkv' => 'video',
      'flv' => 'video',
      '3g2' => 'video',
      '3gp' => 'video',
      'm4v' => 'video',
      /**
       * archive:
       */
      'zip' => 'archive',
      'rar' => 'archive',
      'gz' => 'archive',
      'tar' => 'archive',
      'arj' => 'archive',
      '7z' => 'archive',
      'deb' => 'archive',
      'pkg' => 'archive',
      'rpm' => 'archive',
      'tar.gz' => 'archive',
      'z' => 'archive',
      'apk' => 'archive',
      /**
       * audio:
       */
      'mp3' => 'audio',
      'wav' => 'audio',
      'ogg' => 'audio',
      'wma' => 'audio',
      'flac' => 'audio',
      'webm' => 'audio',
      'it' => 'audio',
      'my' => 'audio',
      'rmi' => 'audio',
      'm2a' => 'audio',
      'mpga' => 'audio',
      's3m' => 'audio',
      'tsi' => 'audio',
      'qcp' => 'audio',
      'vox' => 'audio',
      'snd' => 'audio',
      'aifc' => 'audio',
      'aif' => 'audio',
      'aiff' => 'audio',
      'au' => 'audio',
      'jam' => 'audio',
      'm3u' => 'audio',
      'la' => 'audio',
      'ram' => 'audio',
      'rm' => 'audio',
      'rmm' => 'audio',
      'rmp' => 'audio',
      'sid' => 'audio',
      'ra' => 'audio',
      'vqf' => 'audio',
      'vql' => 'audio',
      'vqe' => 'audio',
      'voc' => 'audio',
      'wav' => 'audio',
      'xm' => 'audio',
      /**
       * Excel:
       */
      'xls' => 'excel',
      'xlsx' => 'excel',
      'ods' => 'excel',
      'fods' => 'excel',
      'xlr' => 'excel',
      /**
       * Word:
       */
      'doc' => 'word',
      'dotm' => 'word',
      'dotx' => 'word',
      'docx' => 'word',
      'wps' => 'word',
      'wks' => 'word',
      'odt' => 'word',
      'wpd' => 'word',
      /**
       * Powerpoint:
       */
      'pptx' => 'powerpoint',
      'odp' => 'powerpoint',
      'pps' => 'powerpoint',
      'ppt' => 'powerpoint',
      'pptx' => 'powerpoint',
      'key' => 'powerpoint',
      /**
       * pdf:
       */
      'pdf' => 'pdf',
      'pdfs' => 'pdf',
      'pdfxml' => 'pdf',
      /**
       * images:
       */
      'ps' => 'image',
      'fif' => 'image',
      'flo' => 'image',
      'svg' => 'image',
      'gif' => 'image',
      'jut' => 'image',
      'nap' => 'image',
      'pic' => 'image',
      'pict' => 'image',
      'jfif' => 'image',
      'jpe' => 'image',
      'jpg' => 'image',
      'jpeg' => 'image',
      'png' => 'image',
      'fpx' => 'image',
      'rp' => 'image',
      'wbmp' => 'image',
      'xif' => 'image',
      'ras' => 'image',
      'svf' => 'image',
      'dxf' => 'image',
      'dwg' => 'image',
      'ico' => 'image',
      'art' => 'image',
      'jps' => 'image',
      'nif' => 'image',
      'pcx' => 'image',
      'pct' => 'image',
      'pnm' => 'image',
      'pbm' => 'image',
      'pgm' => 'image',
      'ppm' => 'image',
      'qif' => 'image',
      'qtif' => 'image',
      'qti' => 'image',
      'rgb' => 'image',
      'tif' => 'image',
      'tiff' => 'image',
      'bmp' => 'image',
      'xwd' => 'image',
      'xbm' => 'image',
      'xpm' => 'image',
      'psd' => 'photoshop',
      'eps' => 'photoshop',
      'ai' => 'illustrator',
      /**
       * Font files:
       */
      'fnt' => 'font',
      'fon' => 'font',
      'otf' => 'font',
      'ttf' => 'font',
  ];
  private static $assosiations = [
      'archive' => 'far fa-file-archive',
      'pdf' => 'fas fa-file-pdf',
      'video' => 'far fa-file-video',
      'audio' => 'far fa-file-audio',
      'powerpoint' => 'far fa-file-powerpoint',
      'word' => 'far fa-file-word',
      'excel' => 'far fa-file-excel',
      'css' => 'fab fa-css3-alt',
      'image' => 'far fa-file-image',
      'photoshop' => 'devicon-photoshop-plain',
      'illustrator' => 'devicon-illustrator-plain',
      'text' => 'far fa-file-alt',
      'html5' => 'fab fa-html5',
      'php' => 'fab fa-php',
      'js' => 'fab fa-js-square',
      'font' => 'fas fa-font',
      'java' => 'fab fa-java',
      'python' => 'fab fa-python',
      'executable' => 'fas fa-cogs',
      'database' => 'fas fa-database',
      'windows' => 'fab fa-windows',
      'code' => 'far fa-file-code',
      'c++' => 'devicon-cplusplus-line',
      'c#' => 'devicon-csharp-line',
      'c' => 'devicon-c-plain',
      'certificate' => 'fas fa-certificate',
  ];

  /**
   * @var Filetype|null singleton instance 
   */
  private static $instance;

  private function __construct(...$classes) {
    
  }

  /**
   * Returns the singleton instance
   * 
   * @return Filetype singleton instance
   */
  public static function instance(): Filetype {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText
   * @return FaIcon new icon object
   */
  public function __invoke(string $fileType, string $screenReaderText = null): FaIcon {
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  array $arguments
   * @return FaIcon new icon object
   */
  public function __call(string $fileType, array $arguments): FaIcon {
    $screenReaderText = array_shift($arguments);
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return FaIcon new icon object
   */
  public static function __callStatic(string $fileType, array $arguments): FaIcon {
    $screenReaderText = array_shift($arguments);
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object representing given file or file type
   *
   * @param  string|SplFileInfo $fileOrExt a file or a file type
   * @param  string $screenReaderText 
   * @return FaIcon new icon object
   */
  public static function get($fileOrExt, string $screenReaderText = null): FaIcon {
    if (array_key_exists($fileOrExt, static::$fileTypeMap)) {
      $icon = static::$assosiations[static::$fileTypeMap[$fileOrExt]];
    } else if (array_key_exists($fileOrExt, static::$assosiations)) {
      $icon = static::$assosiations[$fileOrExt];
    } else {
      if (is_string($fileOrExt)) {
        $file = new SplFileInfo($fileOrExt);
      }
      if (!$file instanceof SplFileInfo) {
        throw new InvalidArgumentException('File cannot be found');
      }
      $ext = $file->getExtension();
      if (array_key_exists($ext, static::$fileTypeMap)) {
        $icon = static::$fileTypeMap[$ext];
      } else {
        $icon = 'far fa-file';
      }
    }
    return new FaIcon($icon, $screenReaderText);
  }

}
