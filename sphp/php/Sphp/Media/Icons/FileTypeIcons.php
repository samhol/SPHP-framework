<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

use Sphp\Exceptions\InvalidArgumentException;
use SplFileInfo;
use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Implementation of FileTypeIconMapper
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FileTypeIcons {

  private array $map;
  private $defaultFile = 'far fa-file';
  private $folder = 'far fa-folder';

  public function __construct(array $map = [], $defaultFile = 'far fa-file', $folder = 'far fa-folder') {
    $this->map = $map;
    $this->defaultFile = $defaultFile;
    $this->folder = $folder;
  }

  public function setExtensionIcon(string $extension, string $icon) {
    $this->map [$extension] = $icon;
    return $this;
  }

  public function createIconFor(string|SplFileInfo $fileOrExt): IconObject {
    $name = $this->getIconNameFor($fileOrExt);
    try {
      $if = new IconFactory();
      return $if->createIcon($name);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage());
    }
  }

  /**
   * Creates an icon object representing given file type
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText
   * @return IconObject new icon object
   */
  public function __invoke(string|SplFileInfo $fileType, ?string $screenReaderText = null): IconObject {
    return $this->createIconFor($fileType, $screenReaderText);
  }

  public function getIconNameForExt(string $ext): string {
    if (!array_key_exists($ext, $this->map)) {
      return $this->defaultFile;
    }
    return $this->map[$ext];
  }

  public function getIconForFileObject(SplFileInfo $info): string {
    if ($info->isDir()) {
      $iconName = $this->folder;
    } else {
      $iconName = $this->getIconNameForExt($info->getExtension());
    }
    return $iconName;
  }

  public function getIconNameFor(string|SplFileInfo $fileOrExt): ?string {
    $iconName = null;
    if ($fileOrExt instanceof SplFileInfo) {
      $iconName = $this->getIconForFileObject($fileOrExt);
    } else if (array_key_exists($fileOrExt, $this->map)) {
      $iconName = $this->map[$fileOrExt];
    } else {
      if (!$fileOrExt instanceof SplFileInfo) {
        $fileOrExt = new \SplFileInfo($fileOrExt);
      }
      $iconName = $this->getIconForFileObject($fileOrExt);
    }
    return $iconName;
  }

  public static function defaultSet(): FileTypeIcons {
    $data = ParseFactory::fromFile(\Sphp\FILE_ICON_MAP);
    $map = [];
    foreach ($data as $group) {
      $iconName = $group['default'];
      foreach ($group['exts'] as $extension => $iconName) {
        if (empty($iconName)) {
          $iconName = $group['default'];
        }
        $map[$extension] = $iconName;
      }
    }
    return new static($map);
  }

}
