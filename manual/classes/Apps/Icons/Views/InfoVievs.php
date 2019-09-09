<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Views;

use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Html\Component;

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
  private $default;

  public function __construct() {
    $this->map = [];
    $this->default = IconGroupInfoViewBuilder;
  }

  public function associate(string $setName, IconGroupInfoViewBuilder $view) {
    $this->map[$setName] = $view;
  }

  public function getViewerFor(string $setName): IconGroupInfoViewBuilder {
    $builder = $this->default;
    if (array_key_exists($setName, $this->map)) {
      $builder = $this->map[$setName];
    }
    return $builder;
  }

  public function getViewFor(IconGroup $iconGroup): Component {
    return $this->getViewerFor($iconGroup->getIconSetName())->createHtmlFor($iconGroup);
  }

}
