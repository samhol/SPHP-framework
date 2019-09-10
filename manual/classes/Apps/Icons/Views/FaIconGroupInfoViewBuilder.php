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
use Sphp\Html\Lists\Dl;
use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Manual\Apps\Icons\IconGroup;

/**
 * Implementation of IconGroupInfoViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaIconGroupInfoViewBuilder extends IconGroupInfoViewBuilder {

  public function __construct() {
    ;
  }

  public function createHtmlFor(IconGroup $iconGroup): Component {
    $container = new Section();
    $classLinker = $method = Factory::sami()->classLinker(FontAwesome::class);
    if ($iconGroup->count() > 1) {
      $container->appendH3('Information for ' . $iconGroup->getLabel() . ' icon group');
    } else {
      $container->appendH3('Information for ' . $iconGroup->getLabel() . ' icon');
    }
    $dl = new Dl();
    $dl->appendTerm('<strong>Icon</strong> versions:');
    $dl->appendDescriptions($iconGroup->getIconNames());
    $container->append($dl);
    $link = $classLinker->getLink(FontAwesome::class . "::i('" . $iconGroup->getGroupName() . "-plain')");
    $container->append("Font icon example: $link");
    return $container;
  }

  public function create(IconGroup $iconGroup): string {
    $grid = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-6');
    foreach ($iconGroup->getIcons() as $iconData) {
      $iconContainer = $this->getIconViewer()->createIcon($iconData);
      $grid->append($iconContainer);
    }
    return (string) $grid;
  }

}
