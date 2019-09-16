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
      Facebook icons
    </h6>
  </div>';
    foreach ($iconGroup->getIcons() as $icon) {
      $output .= $this->buildIcon($icon);
    }
    $output .= '</div>';
    return $output;
  }

  public function buildIcon(IconData $iconData) {
    $output = '
  <div class="grid-x icon-section">
    <div class="small-12 medium-6 columns about-icon">
      <div class="icon">
        <i class="fab fa-facebook icon"></i>
      </div>
      <div class="about-icon-author">
        <p class="author-name">
          Facebook icon
        </p>
        <p class="icon-set">
          <strong>Icon Set:</strong> FontAwesome
        </p>
        <p class="author-mutual">
          <strong>Shahrukh Khan</strong> is a mutual friend.
        </p>
      </div>    
    </div>
    <div class="small-12 medium-6 cell functionality text-center">
      <div class="add-friend-action">
        <button class="button primary small">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
          copy icon class
        </button>
        <button class="button secondary small">
          <i class="fa fa-user-times" aria-hidden="true"></i>
          copy PHP call
        </button>
      </div>
    </div>
  </div>';
    return $output;
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