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
use Sphp\Html\Foundation\Sites\Containers\Popup;

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
   * @var IconViewer 
   */
  private $iconViewer;

  public function __construct(IconViewer $iconViewer = null) {
    $this->heading = 'Iconset';
    if ($iconViewer === null) {
      $iconViewer = new IconViewer();
    }
    $this->iconViewer = $iconViewer;
  }

  public function __destruct() {
    unset($this->iconViewer);
  }

  public function getIconViewer(): IconViewer {
    return $this->iconViewer;
  }

  public function setHeading(string $heading) {
    $this->heading = $heading;
    return $this;
  }

  public function getHtmlFor(IconSetData $iconSetData): string {
    $section = Tags::section();
    $section->addCssClass('example icons');
    $section->appendH2($this->heading);
    $popup = new Popup('<div class="icon-info"><h3>Icongroup information loading...</h3></div>');
    $popup->setOption('multiple-opened', true)->layout()->setSize('large');
    $grid = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-6');
    foreach ($iconSetData as $iconGroup) {
      $icons = $iconGroup->getIcons();
      $iconData = array_shift($icons);
      $iconContainer = $this->getIconViewer()->createComponent($iconData);
      $iconContainer->setAttribute('data-sphp-url', "/manual/snippets/icons/devicon/info.php?iconSet=devicon&name={$iconGroup->getGroupName()}");
      $iconContainer->setAttribute('data-sphp-target', $popup->identify());
      $popup->createController($iconContainer);
      $grid->append($iconContainer);
    }
    $section->append($grid);
    $section->append($popup);
    return (string) $section;
  }

}
