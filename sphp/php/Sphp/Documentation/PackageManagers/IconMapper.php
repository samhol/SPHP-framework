<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\PackageManagers;

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Documentation\PackageManagers\Managers\Package;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use Sphp\Documentation\PackageManagers\Managers\NpmPackage;
use Sphp\Html\Media\Icons\IconTag;

/**
 * Description of IconMapper 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IconMapper {

  private FontAwesome $fa;
  private $default;
  private $packageNameIconMap;

  /**
   * 
   * @param string $icon
   */
  public function __construct(string $icon = 'fas fa-box-open') {
    $this->fa = new FontAwesome();
//$this->fa->fixedWidth(true);
    $this->setDefaultIcon($icon);
    $this->packageNameIconMap = [];
//
    $this->packageNameIconMap['/^(erusev\/parsedown)/'] = 'devicon-markdown-original';
    $this->packageNameIconMap['/^(league\/commonmark)/'] = 'devicon-markdown-original';
    $this->packageNameIconMap['/^(gulp)/'] = 'fab fa-gulp';
    $this->packageNameIconMap['/^(symfony)/'] = 'devicon-symfony-original';
    $this->packageNameIconMap['/^(bootstrap)$/'] = 'fab fa-bootstrap';
    $this->packageNameIconMap['/^(jquery)/'] = 'devicon-jquery-plain';
    $this->packageNameIconMap['/^(npm)/'] = 'fab fa-npm';
  }

  /**
   * Destructs the instance
   */
  public function __destruct() {
    unset($this->fa);
  }

  /**
   * 
   * @param string $icon
   * @return $this
   */
  public function setDefaultIcon(string $icon = null) {
    $this->default = $icon;
    return $this;
  }

  /**
   * 
   * @param string $packageType
   * @param string $icon
   * @return $this
   */
  public function mapPackageNameIcon(string $nameRegEx, string $icon) {
    $this->packageNameIconMap[$nameRegEx] = $icon;
    return $this;
  }

  /**
   * 
   * @param  Package $package
   * @return string the corresponding icon name
   */
  protected function getIconName(Package $package): string {
    $name = $this->default;

    foreach ($this->packageNameIconMap as $needle => $iconName) {
      if (\Sphp\Stdlib\Strings::match($package->getName(), $needle)) {
        $name = $iconName;
        break;
      }
    }

    return $name;
  }

  /**
   * 
   * @param  Package $package
   * @return IconTag
   */
  public function buildIcon(Package $package): IconTag {
    $iconName = $this->getIconName($package);
    return $this->fa->createIcon($iconName);
  }

}
