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
 * Class GettextFile
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class GettextFile {

  public const MO = 'mo';
  public const PO = 'po';
  public const POT = 'pot';

  private SplFileInfo $obj;

  public function __construct(SplFileInfo $file) {
    $this->obj = $file;
  }

  public function __destruct() {
    unset($this->obj);
  }

  public function getFileInfo(): SplFileInfo {
    return $this->obj;
  }

  public function getHash(): string {
    return \md5($this->getFileInfo()->getRealPath());
  }

  public function getFileName(): string {
    return $this->getFileInfo()->getBasename(".{$this->getFileInfo()->getExtension()}");
  }

}
