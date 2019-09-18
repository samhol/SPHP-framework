<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Data;

/**
 * Implementation of FaIconGroupData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaIconGroupData extends IconGroupData {

  /**
   * 
   * @return IconData[]
   */
  public function getIcons(): array {
    $icons = [];
    $iconData['factoryName'] = $this->getProperty('factoryName');
    $iconData['factory'] = $this->getProperty('factory');
    $iconData['name'] = $this->getProperty('name');
    $iconData['unicode'] = $this->getProperty('unicode');
    $iconData['changes'] = $this->getProperty('changes');
    $iconData['label'] = $this->getProperty('label');
    $iconData['searchTerms'] = $this->getProperty('searchTerms');
    foreach ($this->getProperty('styles') as $style) {
      $iconData['style'] = $style;
      $icons[] = new FaIconData($iconData);
    }
    return $icons;
  }

}
