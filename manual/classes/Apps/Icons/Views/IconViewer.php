<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Views;

use Sphp\Manual\Apps\Icons\IconData;
use Sphp\Html\Component;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\IconFactory;

/**
 * Implementation of IconViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconViewer {

  /**
   * @var IconFactory 
   */
  private $iconfactory;

  public function __construct(IconFactory $iconfactory = null) {
    if ($iconfactory === null) {
      $iconfactory = new IconFactory();
    }
    $this->iconfactory = $iconfactory;
  }

  public function __destruct() {
    unset($this->iconfactory);
  }

  public function getIconFactory(): IconFactory {
    return $this->iconfactory;
  }

  public function createComponent(IconData $iconData): Component {
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'font');
    $icon = $this->getIconFactory()->get($iconData->getName());
    $iconContainer->append($icon);
    $content->append($iconContainer);
    $ext = Tags::div($iconData->getName())->addCssClass('ext');
    $content->append($ext);
    return $content;
  }

}
