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
class FaIconGroupInfoViewBuilder extends IconGroupInfoViewBuilder {

  public function __construct(IconViewer $iconfactory = null) {
    parent::__construct($iconfactory);
  }

  public function build(IconGroup $iconGroup) {
    $output = '<div class="icon-group">
  <div class="add-people-header">
    <h6 class="header-title">
      '.$iconGroup->getIconSetName() .' '. $iconGroup->getLabel() . ' icons
    </h6>
  </div>';
    foreach ($iconGroup->getIcons() as $icon) {
      $output .= $this->buildIcon($icon);
    }
    $output .= '</div>';
    return $output;
  }

  public function buildIcon(IconData $iconData) {
    $grid = new BasicRow();
    $grid->addCssClass('icon-section');
    $icon = Tags::div($iconData->createIcon());
    $icon->addCssClass('icon');
    $grid->appendCell($icon)->shrink();
    $grid->appendCell($this->createIconInfo1($iconData))->addCssClass('about-icon')->auto();
    return $grid;
  }

  public function createIconInfo1(IconData $iconData): Ul {
    $ul = new Ul();
   // $ul->append('<strong>Icon Set:</strong> ' . $iconData->getIconSetName())->addCssClass('icon-set-name');
    //$ul->append('<strong>Label:</strong> ' . $iconData->getLabel())->addCssClass('icon-label');
    
    $ul->append('<strong>CSS class:</strong> ' . $iconData->getName())->addCssClass('icon-name');
    $classLinker = $method = Factory::sami()->classLinker(FontAwesome::class);
    $link = $classLinker->getLink(FontAwesome::class . "::i('" . $iconData->getName() . "')");
    $ul->append('<strong>PHP factory call:</strong> ' . $link);
    return $ul->addCssClass('no-bullet');
  }

  public function createHtmlFor(IconGroup $iconGroup): Component {
    $container = new Section();
    $container->addCssClass('icon-group-info');
    $classLinker = $method = Factory::sami()->classLinker(FontAwesome::class);
    if ($iconGroup->count() > 1) {
      $container->appendH3('Information for ' . $iconGroup->getLabel() . ' icon group');
    } else {
      $container->appendH3('Information for ' . $iconGroup->getLabel() . ' icon');
    }
    $container->appendH4('Icon <small>versions</small>');
    $container->append($this->create($iconGroup));
    $link = $classLinker->getLink(FontAwesome::class . "::i('" . $iconGroup->getGroupName() . "-plain')");
    $container->append("Font icon example: $link");
    return $container;
  }

  public function createIconInfo(IconData $iconData) {
    $row = new \Sphp\Html\Flow\Section();
    $icon = $this->getIconViewer()->createIcon($iconData);
    $row->appendArticle($icon)->addCssClass('icon-cell text-center');
    $row->appendArticle('<span class="icon-name">' . $iconData->getName() . '</span>  <span class="fas fa-copy">copy</span>')->addCssClass('icon-info-cell');
    return $row;
  }

  public function create(IconGroup $iconGroup): string {
    $grid = new BlockGrid('small-up-2', 'medium-up-2', 'large-up-2');
    foreach ($iconGroup->getIcons() as $icon) {
      $grid->append($this->createIconInfo($icon));
    }
    return (string) $grid;
  }

}
