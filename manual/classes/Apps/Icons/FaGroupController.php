<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

/**
 * Implementation of FaGroupController
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaGroupController {

  /**
   * @var IconSetData
   */
  private $data;

  public function __construct(IconSetData $data) {
    $this->data = $data;
    $this->view = new Views\FaIconsView($data);
  }

  
  public function getData(string $type): IconSetData {
    return $this->data->filter(function(IconGroup $iconData) use ($type) {
              if ($iconData instanceof \Sphp\Manual\Apps\Icons\FontAwesomeIconGroup) {
                return in_array($type, $iconData->getStyles());
              }
              return false;
            });
  }
  
  

}
