<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\Data;

use SplFileInfo;

/**
 * Class MoFile
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MoFile extends GettextFile {

  public function __construct(\SplFileInfo $file) {
    if ($file->getExtension() !== 'mo') {
      throw new GettextException('$file is not valid Gettext MO-file');
    }
    parent::__construct($file);
  }

  public function hasPoFile(): bool {
    return is_file($this->getFileInfo()->getPath() . '/' . $this->getFileName() . '.po');
  }

  public function getPoFile(): ?PoFile {
    $file = null;
    if ($this->hasPoFile()) {
      $spl = new SplFileInfo($this->getFileInfo()->getPath() . '/' . $this->getFileName() . '.po');
      $file = new PoFile($spl);
    }
    return $file;
  }

}
