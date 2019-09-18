<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Data;

use Sphp\Html\Media\Icons\Icon;

/**
 * Implementation of DeviconData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DeviconData extends IconData {

  public function isSvg() :bool {
    return $this->getProperty('type') === 'svg';
  }
  
  public function createIcon(): Icon {
    $factory = $this->getProperty('factory');
    return (new $factory)->get($this->getIconName());
  }

  public function getIconName(): string {

    return $this->getProperty('font');
  }

}
