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

use Sphp\Apps\PoSearch\Exceptions\GettextException;
use SplFileInfo;

/**
 * Class PotFile
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PotFile extends EntryContainerFile {

  public function __construct(SplFileInfo $file) {
    if ($file->getExtension() !== 'pot') {
      throw new GettextException('$file is not valid PO Template File');
    }
    parent::__construct($file);
  }

  public function hasPoFiles(): bool {
    return count($this->getPoFiles()) > 0;
  }

  public function getPoFiles(): array {
    $pos = glob($this->getFileInfo()->getPath() . '/*/' . $this->getFileName() . '.po');
    $files = [];
    foreach ($pos as $path) {
      $files[] = new PoFile($path);
    }
    return $files;
  }

}
