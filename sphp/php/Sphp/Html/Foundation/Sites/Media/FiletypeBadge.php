<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Media\Icons;
use SplFileInfo;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of FiletypeBadge
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FiletypeBadge extends Badge {

  /**
   * 
   * @param  SplFileInfo|string $file
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function __construct($file) {
    if (is_string($file)) {
      $file = new SplFileInfo($file);
    } else if ($file instanceof SplFileInfo) {
      $file = $file;
    } else {
      throw new InvalidArgumentException('Filetype cannot be resolved');
    }
    $icon = Icons::fileType($file);
    parent::__construct($icon);
    $this->cssClasses()->protect($file->getExtension());
  }

}
