<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\PackageManagers;

use Sphp\Html\Content;
use Sphp\Html\Tags;
use Sphp\Html\Navigation\A;
use Sphp\Documentation\PackageManagers\Managers\Package;

/**
 * Description of Packages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PackageHyperlinkBuilder {
 
  private IconMapper $iconBuilder;

  public function __construct(IconMapper $iconBuilder = null) {
    if ($iconBuilder === null) {

      $iconBuilder = new IconMapper();
    }
    $this->iconBuilder = $iconBuilder;
    $this->iconMap = [];
    $this->iconMap[PackageManagers\NpmPackage::class] = 'fab fa-npm';
  }

  public function __destruct() {
    unset($this->iconBuilder);
  }

  public function setIcon(IconMapper $icon = null) {
    $this->iconBuilder = $icon;
    return $this;
  }

  public function getIconBuilder(): IconMapper {
    return $this->iconBuilder;
  }

  public function getIcon(Package $package): ?Content {
    $content = Tags::span($this->iconBuilder->buildIcon($package))->addCssClass('icon');
    return $content;
  }

  protected function buildText(Package $package): string {
    $output = Tags::span($package->getName())->addCssClass('name') . ' ' .
            Tags::span($package->getVersion())->addCssClass('version');
    return (string) Tags::span($output)->addCssClass('text');
  }

  public function buildContent(Package $package): string {
    $content = Tags::span($this->getIcon($package) . $this->buildText($package));
    return (string) $content;
  }

  public function BuildLink(Package $package): A {
    $a = new A($package->getUrl(), $this->buildContent($package), '_blank');
    return $a;
  }

  public function buildList(iterable $packageData) {
    $ul = Tags::ul();
    $ul->addCssClass('packages');
    foreach ($packageData as $component) {
      if ($component instanceof Package) {
        $ul->append($this->BuildLink($component));
      }
    }
    return $ul;
  }

}
