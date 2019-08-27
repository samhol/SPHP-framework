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
use Sphp\Exceptions\BadMethodCallException;

/**
 * File type icon factory
 * 
 * @method \Sphp\Html\Media\Icons\IconTag csv(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag db(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag mdb(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag dbf(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag sql(string $screenReaderLabel = null) creates a new icon object
 * 
 * 
 * @method \Sphp\Html\Media\Icons\IconTag java(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag jar(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag class(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\IconTag php(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag php3(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag phtml(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag phar(string $screenReaderLabel = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\IconTag js(string $screenReaderLabel = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag json(string $screenReaderLabel = null) creates a new icon object
 * 
 * 
 * @method \Sphp\Html\Media\Icons\IconTag txt(string $screenReaderLabel = null) creates a new icon object
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FileIcons {

  /**
   * @var FileTypeIconMapper
   */
  private $map;

  /**
   * @var FileIcons|null singleton instance 
   */
  private static $instance;

  /**
   * @var array 
   */
  private $settings;

  public function __construct(string $defaultTagname = 'i', FileTypeIconMapper $map = null) {
    $this->settings = [];
    $this->settings['tag'] = $defaultTagname;
    if ($map === null) {
      $map = FileTypeIconMapper::instance();
    }
    $this->map = $map;
  }

  public function __destruct() {
    unset($this->map);
  }

  /**
   * 
   * @param  string $fileOrExt
   * @return IconTag
   * @throws InvalidArgumentException
   */
  public function iconFor(string $fileOrExt): IconTag {
    $name = $this->map->getIconNameFor($fileOrExt);
    if ($name === null) {
      throw new InvalidArgumentException($fileOrExt . ' is not mapped');
    }
    return new IconTag($name, $this->settings['tag']);
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText
   * @return IconTag new icon object
   */
  public function __invoke(string $fileType, string $screenReaderText = null): IconTag {
    try {
      return $this->iconFor($fileType, $screenReaderText);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Invocation failure: cannot associate ' . $fileType . ' to an icon', $ex->getCode(), $ex);
    }
    return $this->iconFor($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  array $arguments
   * @return $iconName new icon object
   */
  public function __call(string $fileType, array $arguments): IconTag {
    try {
      return $this->iconFor($fileType);
    } catch (\Exception $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return IconTag new icon object
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $fileType, array $arguments): IconTag {
    try {
      $instance = static::instance();
      return $instance->__call($fileType, $arguments);
    } catch (\Exception $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Creates an icon object representing given file or file type
   *
   * @param  string|SplFileInfo $fileOrExt a file or a file type
   * @param  string $screenReaderText 
   * @return FontAwesomeIcon new icon object
   */
  public static function get($fileOrExt, string $screenReaderText = null): FontAwesomeIcon {
    $map = new FileTypeIconMapper();
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
    return static::foo($iconName, $screenReaderText);
  }

  /**
   * Returns the singleton instance
   * 
   * @return FileIcons singleton instance
   */
  public static function instance(): FileIcons {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
