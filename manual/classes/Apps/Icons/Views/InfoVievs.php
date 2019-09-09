<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Views;

/**
 * Implementation of InfoVievs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class InfoVievs {

  private $map;

  public function __construct() {
    $this->map = [];
  }

  public function associate(string $setName, IconGroupInfoViewBuilder $view) {
    $this->map[$setName] = $view;
  }

  public function getViewFor($setName): ?IconGroupInfoViewBuilder {
    return $this->map[$setName];
  }

}
