<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Views;

use Sphp\Html\Component;
use Sphp\Html\Flow\Section;
use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\Views\IconViewer;
use Sphp\Manual\Apps\Icons\IconData;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Tags;
use Sphp\Html\Lists\Ul;

/**
 * Implementation of IconGroupInfoViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconGroupInfoViewBuilder {

  /**
   * @var IconViewer 
   */
  private $iconfactory;

  public function __construct(IconViewer $iconfactory = null) {
    if ($iconfactory === null) {
      $iconfactory = new IconViewer();
    }
    $this->iconfactory = $iconfactory;
  }

  public function __destruct() {
    unset($this->iconfactory);
  }

  public function getIconViewer(): IconViewer {
    return $this->iconfactory;
  }

  public function createHtmlFor(IconGroup $iconGroup): Component {
    $iconGroupContainer = new Section();
    $iconGroupContainer->addCssClass('icon-group');
    if ($iconGroup->count() > 1) {
      $iconGroupContainer->appendH3($iconGroup->getIconSetName() . ' ' . $iconGroup->getLabel() . ' icon group');
    } else {
      $iconGroupContainer->appendH3($iconGroup->getIconSetName() . ' ' . $iconGroup->getLabel() . ' icon');
    }
    foreach ($iconGroup->getIcons() as $icon) {
      $iconGroupContainer->append($this->buildIcon($icon));
    }
    return $iconGroupContainer;
  }

  private function buildIcon(IconData $iconData) {
    $grid = new BasicRow();
    $grid->addCssClass('icon-section');
    $icon = Tags::div($iconData->createIcon());
    $icon->addCssClass('icon');
    $grid->appendCell($icon)->shrink();
    $grid->appendCell($this->createIconInfo1($iconData))->addCssClass('about-icon')->auto();
    return $grid;
  }

  private function createIconInfo1(IconData $iconData): Section {
    $section = new Section();
    $section->addCssClass('icon-group-info');
    $ul = new Ul();
    $ul->addCssClass('no-bullet');
    $section->append($ul);
    $ul->append('<strong>CSS class:</strong> <span class="value">' . $iconData->getName() . '</span> <span class="fas fa-copy">copy</span>')->addCssClass('icon-name');
    $classLinker = $method = Factory::sami()->classLinker(FontAwesome::class);
    $link = $classLinker->getLink('\\' . FontAwesome::class . "::i('" . $iconData->getName() . "')")->addCssClass('value');
    $ul->append('<strong>PHP factory call:</strong> ' . $link);
    return $section;
  }

  private function createIconInfo(IconData $iconData) {
    $row = new Section();
    $icon = $this->getIconViewer()->createIcon($iconData);
    $row->appendArticle($icon)->addCssClass('icon-cell text-center');
    $row->appendArticle('<span class="icon-name">' . $iconData->getName() . '</span> <span class="fas fa-copy">copy</span>')->addCssClass('icon-info-cell');
    return $row;
  }

  private function create(IconGroup $iconGroup): string {
    $grid = new BlockGrid('small-up-2', 'medium-up-2', 'large-up-2');
    foreach ($iconGroup->getIcons() as $icon) {
      $grid->append($this->createIconInfo($icon));
    }
    return (string) $grid;
  }

}
