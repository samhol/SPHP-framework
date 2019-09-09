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
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Manual\Apps\Icons\IconGroup;

/**
 * Implementation of IconGroupInfoViewBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconGroupInfoViewBuilder {

  public function __construct() {
    ;
  }


  public function createHtmlFor(IconGroup $iconGroup): Component {
    $container = new Section();
    $classLinker = $method = Factory::sami()->classLinker(DevIcons::class);
    $container->appendH3('Information for ' . $iconGroup->getLabel() . ' icon group');
    $dl = new Dl();
    $dl->appendTerm('<strong>Icon</strong> versions:');
    $dl->appendDescriptions($iconGroup->getIconNames());
    $container->append($dl);
    $link = $classLinker->getLink(DevIcons::class . "::i('" . $iconGroup->getGroupName() . "-plain')");
    $container->append("Font icon example: $link");
    return $container;
  }

}
