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
   * @var IconsData
   */
  private $data;

  public function __construct(IconsData $data) {
    $this->data = $data;
    $this->view = new Views\FaIconsView($data);
  }

  
  public function getData(string $type): IconsData {
    return $this->data->filter(function(IconInformation $iconData) use ($type) {
              if ($iconData instanceof \Sphp\Manual\Apps\Icons\FaIconInformation) {
                return in_array($type, $iconData->getStyles());
              }
              return false;
            });
  }
  
  

}
