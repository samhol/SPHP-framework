<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

/**
 * Description of PackageListBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PackageListBuilder {

  public function build() {
    $required = getComposerPackages();
    $zends = Arrays::findKeysLike($required, 'zendframework');
    $ul = new Ul();
    $ul->addCssClass('packages');
    $fa = new FontAwesome();
    $fa->fixedWidth(true);
    foreach ($zends as $component => $version) {
      $package = str_replace('zendframework/', '', $component);
      $ul->appendLink("https://github.com/$component", Tags::span($fa->createIcon('fab fa-github'))->addCssClass('icon') . Tags::span($package)->addCssClass('text'));
    }
  }

}
