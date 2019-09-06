<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Views;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Manual\Apps\Icons\IconSetData;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\IconFactory;

/**
 * Implementation of FaIconsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconsView {

  /**
   * @var IconSetData 
   */
  private $data;

  /**
   * @var IconFactory 
   */
  private $iconfactory;

  public function __construct(IconSetData $data) {
    $this->data = $data;
    $this->section = Tags::section();
    $this->heading = 'Iconset';
    $this->iconfactory = new IconFactory();
  }

  public function getIconFactory(): IconFactory {
    return $this->iconfactory;
  }

  public function setHeading(string $heading) {
    $this->heading = $heading;
    return $this;
  }

  public function getHtmlFor(): string {
    $section = Tags::section();
    $section->addCssClass('example icons');
    $section->appendH2($this->heading);
    $grid = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-6');
    foreach ($this->data as $iconGroup) {
      $content = Tags::div()->addCssClass('icon-container');
      $iconContainer = Tags::div()->addCssClass('icon', 'font');
      $content->append($iconContainer);
      $ext = Tags::div()->addCssClass('ext');
      $content->append($ext);
      $iconNames = $iconGroup->getIconNames();
      $iconName = array_shift($iconNames);
      $icon = $this->getIconFactory()->get($iconName);
      $iconContainer->append($icon);
      $ext->append($iconGroup->getLabel());
      $grid->append($content);
    }
    $section->append($grid);
    return (string) $section;
  }

}
