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
 * Implementation of FaIconData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaIconData extends IconData {

  public function getIconName(): string {
    $typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
    $style = $typeMap[$this->getProperty('style')];
    $name = "$style fa-{$this->getProperty('name')}";

    return $name;
  }

  public function createIcon(): Icon {
    $factory = $this->getProperty('factory');
    return (new $factory)->get($this->getIconName());
  }

}
