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
 * @method \Sphp\Html\Media\Icons\IconTag csv(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag db(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag mdb(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag dbf(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag sql(string $title = null) creates a new icon object
 * 
 * 
 * @method \Sphp\Html\Media\Icons\IconTag java(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag jar(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag class(string $title = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\IconTag php(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag php3(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag phtml(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag phar(string $title = null) creates a new icon object
 * 
 * @method \Sphp\Html\Media\Icons\IconTag js(string $title = null) creates a new icon object
 * @method \Sphp\Html\Media\Icons\IconTag json(string $title = null) creates a new icon object
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

  /**
   * Constructor
   * 
   * @param string $defaultTagname
   * @param FileTypeIconMapper|null $map
   */
  public function __construct(string $defaultTagname = 'i', FileTypeIconMapper $map = null) {
    $this->settings = [];
    $this->settings['tag'] = $defaultTagname;
    if ($map === null) {
      $map = FileTypeIconMapper::instance();
    }
    $this->map = $map;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->map);
  }

  /**
   * 
   * @param  string $fileOrExt
   * @return IconTag
   * @throws InvalidArgumentException
   */
  public function iconFor($fileOrExt, string $title = null): IconTag {
    $name = $this->map->getIconNameFor($fileOrExt);
    if ($name === null) {
      throw new InvalidArgumentException("File or extension cannot be parsed");
    }
    $icon = new IconTag($name, $this->settings['tag']);
    $icon->setTitle($title);
    return $icon;
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText
   * @return IconTag new icon object
   */
  public function __invoke($fileType, string $screenReaderText = null): IconTag {
    try {
      return $this->iconFor($fileType, $screenReaderText);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Invocation failed: cannot associate filetype to an icon', $ex->getCode(), $ex);
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
      $title = null;
      if (count($arguments) > 0) {
        $title = $arguments[0];
      }
      $icon = $this->iconFor($fileType, $title);
      return $icon;
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
   * @param  string $title 
   * @return FontAwesomeIcon new icon object
   */
  public static function get($fileOrExt, string $title = null): FontAwesomeIcon {
    $instance = static::instance();
    return static::instance()->iconFor($fileOrExt, $title);
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
