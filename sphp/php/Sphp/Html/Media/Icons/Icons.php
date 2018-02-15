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
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Icons {

  /**
   * @var string[] 
   */
  private static $fileTypeMap = [
      'pdf' => 'file-pdf-o',
      'zip' => 'file-archive-o',
      'rar' => 'file-archive-o',
      'gz' => 'file-archive-o',
      'tar' => 'file-archive-o',
      'arj' => 'file-archive-o',
      'arj' => 'file-archive-o',
      'mp3' => 'file-audio-o',
      'wav' => 'file-audio-o',
      'ogg' => 'file-audio-o',
      'wma' => 'file-audio-o',
      'flac' => 'file-audio-o',
      'webm' => 'file-audio-o',
      'xls' => 'file-excel-o',
      'xlsx' => 'file-excel-o',
      'ods' => 'file-excel-o',
      'fods' => 'file-excel-o',
      'txt' => 'file-text-o',
      'jpg' => 'file-picture-o',
      'jpeg' => 'file-picture-o',
      'gif' => 'file-picture-o',
      'tiff' => 'file-picture-o',
      'png' => 'file-picture-o',
      'doc' => 'file-word-o',
      'docx' => 'file-word-o',
      'css' => 'css3',
      'html' => 'html5',
      'htm' => 'html5',
      'php' => 'html5'
  ];

  /**
   * Generates a FontAwesome icon
   * 
   * @param  string $iconName
   * @return Icon the icon object generated
   * @link   http://fontawesome.io/ Font Awesome site
   */
  public static function fontAwesome(string $iconName, string $screenReaderText = null): Icon {
    if (!Strings::startsWith($iconName, 'fa-')) {
      $iconName = "fa-$iconName";
    }
    return new Icon(['fa', $iconName], $screenReaderText);
  }

  /**
   * Generates a Foundation icon
   * 
   * @param  string $iconName the icon name
   * @return Icon the icon object generated
   */
  public static function foundation(string $iconName, string $screenReaderText = null): Icon {
    if (!Strings::startsWith($iconName, 'fi-')) {
      $iconName = 'fi-' . $iconName;
    }
    return new Icon(['fi', $iconName], $screenReaderText);
  }

  /**
   * Generates a Devicon icon
   * 
   * @param  string $iconName the icon name
   * @return Icon the icon object generated
   */
  public static function devicon(string $iconName, string $screenReaderText = null): Icon {
    if (!Strings::startsWith($iconName, 'devicon-')) {
      $iconName = 'devicon-' . $iconName;
    }
    return new Icon($iconName, $screenReaderText);
  }

  /**
   * Generates a file type icon object using Font Awesome 
   * 
   * @param  string|SplFileInfo $file the file
   * @return Icon the icon object generated
   * @throws InvalidArgumentException if given tag name is invalid
   */
  public static function fileType($file, string $screenReaderText = null): Icon {
    if (is_string($file)) {
      $file = new SplFileInfo($file);
    } else if (!$file instanceof SplFileInfo) {
      throw new InvalidArgumentException('File cannot be found');
    }
    $ext = $file->getExtension();
    if (array_key_exists($ext, static::$fileTypeMap)) {
      $icon = static::$fileTypeMap[$ext];
    } else {
      $icon = 'file-o';
    }
    return static::fontAwesome($icon, $screenReaderText);
  }

}
