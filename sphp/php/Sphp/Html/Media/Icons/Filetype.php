<?php

/**
 * Icons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

use SplFileInfo;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;

/**
 * Description of Icons
 * 
 * 
 * @method \Sphp\Html\\Media\Icons\Icon facebookSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon twitterSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon googlePlusSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon githubSquare(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\\Media\Icons\Icon js(string $screenReaderLabel = null) creates a new icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Filetype {

  /**
   * @var string[] 
   */
  private static $fileTypeMap = [
      /**
       * Text:
       */
      'asp' => 'text',
      'htx' => 'text',
      'acgi' => 'text',
      'htmls' => 'text',
      'mcf' => 'text',
      'pas' => 'text',
      'lst' => 'text',
      'com' => 'text',
      'conf' => 'text',
      'def' => 'text',
      'cxx' => 'text',
      'txt' => 'text',
      'c++' => 'text',
      'log' => 'text',
      'list' => 'text',
      'mar' => 'text',
      'g' => 'text',
      'c' => 'text',
      'text' => 'text',
      'sdml' => 'text',
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
      'cc' => 'text',
      'cpp' => 'text',
      'htc' => 'text',
      'f90' => 'text',
      'for' => 'text',
      'f77' => 'text',
      'f' => 'text',
      'h' => 'text',
      'hh' => 'text',
      'jav' => 'text',
      'java' => 'text',
      'lsx' => 'text',
      'm' => 'text',
      'p' => 'text',
      'hlb' => 'text',
      'csh' => 'text',
      'el' => 'text',
      'ksh' => 'text',
      'lsp' => 'text',
      'pl' => 'text',
      'pm' => 'text',
      'py' => 'text',
      'rexx' => 'text',
      'sh' => 'text',
      'tcl' => 'text',
      'tcsh' => 'text',
      'zsh' => 'text',
      'shtml' => 'text',
      'ssi' => 'text',
      'etx' => 'text',
      'sgm' => 'text',
      'sgml' => 'text',
      'talk' => 'text',
      'spc' => 'text',
      'uil' => 'text',
      'uue' => 'text',
      'uu' => 'text',
      'vcs' => 'text',
      'xml' => 'text',
      /**
       * Video:
       */
      'afl' => 'video',
      'avs' => 'video',
      'm2v' => 'video',
      'm1v' => 'video',
      'mpe' => 'video',
      'mpa' => 'video',
      'mpg' => 'video',
      'mpeg' => 'video',
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
      /**
       * pdf:
       */
      'pdf' => 'pdf',
      /**
       * archive:
       */
      'zip' => 'archive',
      'rar' => 'archive',
      'gz' => 'archive',
      'tar' => 'archive',
      'arj' => 'archive',
      'arj' => 'archive',
      /**
       * Video:
       */
      'mp3' => 'audio',
      'wav' => 'audio',
      'ogg' => 'audio',
      'wma' => 'audio',
      'flac' => 'audio',
      'webm' => 'audio',
      'it' => 'audio',
      'pfunk' => 'audio',
      'funk' => 'audio',
      'my' => 'audio',
      'rmi' => 'audio',
      'm2a' => 'audio',
      'mpga' => 'audio',
      's3m' => 'audio',
      'tsi' => 'audio',
      'tsp' => 'audio',
      'qcp' => 'audio',
      'vox' => 'audio',
      'snd' => 'audio',
      'aifc' => 'audio',
      'aif' => 'audio',
      'aiff' => 'audio',
      'au' => 'audio',
      'gsd' => 'audio',
      'gsm' => 'audio',
      'jam' => 'audio',
      'lam' => 'audio',
      'mod' => 'audio',
      'm3u' => 'audio',
      'lma' => 'audio',
      'la' => 'audio',
      'ram' => 'audio',
      'rm' => 'audio',
      'rmm' => 'audio',
      'rmp' => 'audio',
      'rpm' => 'audio',
      'sid' => 'audio',
      'ra' => 'audio',
      'vqf' => 'audio',
      'vql' => 'audio',
      'vqe' => 'audio',
      'mjf' => 'audio',
      'voc' => 'audio',
      'wav' => 'audio',
      'xm' => 'audio',
      'xls' => 'excel',
      'xlsx' => 'excel',
      'ods' => 'excel',
      'fods' => 'excel',
      'txt' => 'text',
      'md' => 'text',
      'doc' => 'word',
      'dotm' => 'word',
      'dotx' => 'word',
      'docx' => 'word',
      'css' => 'css',
      'html' => 'html5',
      'htmls' => 'text',
      'htm' => 'html5',
      /**
       * PHP:
       */
      'php' => 'php',
      'php3' => 'php',
      'phtml' => 'php',
      'phar' => 'php',
      /**
       * images:
       */
      'bm' => 'image',
      'rast' => 'image',
      'fif' => 'image',
      'turbot' => 'image',
      'flo' => 'image',
      'g3' => 'image',
      'gif' => 'image',
      'iefs' => 'image',
      'ief' => 'image',
      'jfif-tbnl' => 'image',
      'jut' => 'image',
      'nap' => 'image',
      'naplps' => 'image',
      'pic' => 'image',
      'pict' => 'image',
      'jfif' => 'image',
      'jpe' => 'image',
      'jpg' => 'image',
      'jpeg' => 'image',
      'x-png' => 'image',
      'png' => 'image',
      'fpx' => 'image',
      'rf' => 'image',
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
      'niff' => 'image',
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
  ];
  private static $assosiations = [
      'archive' => 'far fa-file-archive',
      'pdf' => 'far fa-file-pdf',
      'video' => 'far fa-file-video',
      'audio' => 'far fa-file-audio',
      'word' => 'far fa-file-word',
      'excel' => 'far fa-file-excel',
      'css' => 'fab fa-css3',
      'image' => 'far fa-file-image',
      'text' => 'far fa-file-alt',
      'html5' => 'fab fa-html5',
      'php' => 'fab fa-php',
      'js' => 'fab fa-js-square',
  ];

  /**
   * Creates a HTML object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return AbstractIcon the corresponding component
   */
  public static function __callStatic(string $fileType, array $arguments): AbstractIcon {
    $screenReaderText = array_shift($arguments);
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates a HTML object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return AbstractIcon the corresponding component
   */
  public static function get(string $fileType, string $screenReaderText): AbstractIcon {
    if (array_key_exists($fileType, static::$fileTypeMap)) {
      $icon = static::$assosiations[static::$fileTypeMap[$fileType]];
    } else {
      $icon = 'far fa-file';
    }
    return new FaIcon($icon, $screenReaderText);
  }

  /**
   * Generates a file type icon object using Font Awesome 
   * 
   * @param  string|SplFileInfo $file the file
   * @return Icon the icon object generated
   * @throws InvalidArgumentException if given tag name is invalid
   */
  public static function fileType($file, string $screenReaderText = null): AbstractIcon {
    if (is_string($file)) {
      $file = new SplFileInfo($file);
    } else if (!$file instanceof SplFileInfo) {
      throw new InvalidArgumentException('File cannot be found');
    }
    $ext = $file->getExtension();
    if (array_key_exists($ext, static::$fileTypeMap)) {
      $icon = static::$fileTypeMap[$ext];
    } else {
      $icon = 'far fa-file';
    }
    return static::get($icon, $screenReaderText);
  }

}
