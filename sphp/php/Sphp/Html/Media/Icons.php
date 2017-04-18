<?php

/**
 * Icons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\Document;
use SplFileInfo;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;

/**
 * Description of Icons
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-17
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Icons {

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
   * 
   * @param  string $icon
   * @param  string $tagName the tag name of the component
   * @return ComponentInterface
   * @throws \Sphp\Exceptions\InvalidArgumentException if given tag name is invalid
   */
  public static function get($icon, $tagName = 'i') {
    return Document::get($tagName)->cssClasses()->lock($icon);
  }

  /**
   * 
   * @param  string $iconName
   * @param  string $tagName the tag name of the component
   * @return ComponentInterface
   * @throws \Sphp\Exceptions\InvalidArgumentException if given tag name is invalid
   */
  public static function fontAwesome($iconName, $tagName = 'i') {
    if (!Strings::startsWith($iconName, 'fa-')) {
      $iconName = "fa-$iconName";
    }
    $icon = Document::get($tagName);
    $icon->cssClasses()->lock(['fa', $iconName]);
    return $icon;
  }

  /**
   * 
   * @param  string|SplFileInfo $file
   * @param  string $tagName optional tag name of the component
   * @return ComponentInterface
   * @throws \Sphp\Exceptions\InvalidArgumentException if given tag name is invalid
   */
  public static function fileType($file, $tagName = 'i') {
    if (is_string($file)) {
      $file = new SplFileInfo($file);
    } else if (!$file instanceof SplFileInfo) {
      throw new InvalidArgumentException();
    }
    $ext = $file->getExtension();
    if (array_key_exists($ext, static::$fileTypeMap)) {
      $icon = static::$fileTypeMap[$ext];
    } else {
      $icon = 'file-o';
    }
    return static::fontAwesome($icon, $tagName);
  }

}
