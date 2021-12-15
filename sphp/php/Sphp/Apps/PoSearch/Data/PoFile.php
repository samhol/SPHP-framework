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
use Sphp\Apps\PoSearch\Exceptions\GettextException;

/**
 * The PoFile class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PoFile extends EntryContainerFile {

  private string $lang;

  public function __construct(SplFileInfo $file) {
    if ($file->getExtension() !== 'po') {
      throw new GettextException('$file is not valid Gettext PO-file');
    }
    parent::__construct($file);
    $realPath = $this->getFileInfo()->getRealPath();
    //$path = $fileObj->getPath();
    $path = str_replace('/LC_MESSAGES', '', $this->getFileInfo()->getPath());
    $parts = explode('/', $path);
    $lang = array_pop($parts);
    // echo $lang;  
    $this->lang = $lang;
  }

  public function getLang(): string {
    return $this->lang;
  }

  public function hasMoFile(): bool {
    //echo $this->obj->getPath() . '/' . $this->obj->getBasename('.po') . '.mo';
    return is_file($this->getFileInfo()->getPath() . '/' . $this->getFileInfo()->getBasename('.po') . '.mo');
  }

  public function getMoFile(): ?MoFile {
    $mo = null;
    if ($this->hasMoFile()) {
      $moInfo = new SplFileInfo($this->getFileInfo()->getPath() . '/' . $this->getFileInfo()->getBasename('.po') . '.mo');
      $mo = new MoFile($moInfo);
    }
    return $mo;
  }

}
