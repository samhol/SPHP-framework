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
use Sphp\Manual\Apps\Icons\IconsData;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Manual\Apps\Icons\FaIconInformation;

/**
 * Implementation of FaIconsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaIconsView {

  private $data;

  public function __construct($data) {
    $this->data = $data;
  }

  public function getHtmlFor(IconsData $data): string {
    $types = ['fas' => 'Solid', 'far' => 'Regular', 'fab' => 'Brand'];
    $type = 'far';
    $show = $types[$type];

    $headingNote = ucfirst($show);

    $section = Tags::section();
    $section->addCssClass('example icons', 'fontawesome');
    $section->appendH2("Font Awesome <small>$headingNote icons</small>");

    $grid = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-6');
    $fa = new FontAwesome();
    $fa->fixedWidth(true);
    foreach ($this->data as $name => $data) {
      if (!$data instanceof FaIconInformation) {
        throw new \Exception;
      }
      $content = Tags::div()->addCssClass('icon-container');
      $iconContainer = Tags::div()->addCssClass('icon', 'font');
      $content->append($iconContainer);
      $ext = Tags::div()->addCssClass('ext');
      $content->append($ext);
      $icon = $fa("$type fa-$name");
      $iconContainer->append($icon);
      $ext->append("fa-$name");
      $iconContainer->setAttribute('title', 'Unicode: ' . $data->getUnicode());
      $grid->append($content);
      //}
    }
    $section->append($grid);
    return (string) $section;
  }

}
