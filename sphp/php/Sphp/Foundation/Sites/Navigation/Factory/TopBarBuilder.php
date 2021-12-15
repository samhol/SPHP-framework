<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Navigation\Factory;

use Sphp\Foundation\Sites\Navigation\Bars\TopBar;
use Sphp\Foundation\Sites\Navigation\ResponsiveMenu;
use Sphp\Foundation\Sites\Navigation\Factory\MenuBuilder;
use Sphp\Foundation\Sites\Navigation\Menu;

/**
 * Class TopBarBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TopBarBuilder {

  /**
   * @var string|null 
   */
  private $activeURL;

  /**
   * 
   * @param string|null $url
   */
  public function setActiveURL(string $url = null) {
    $this->activeURL = $url;
  }

  public function buildBar(iterable $data): TopBar {
    $topBar = new TopBar();
    if (array_key_exists('left', $data['topbar'])) {

      foreach ($data['topbar']['left'] as $type => $leftData) {
        if ($type === 'menu') {
          $topBar->left()->append($this->buildMenu($leftData));
        }
      }
    }
    if (array_key_exists('right', $data['topbar'])) {
      foreach ($data['topbar']['right'] as $type => $rightData) {
        if ($type === 'menu') {
          $topBar->right()->append($this->buildMenu($rightData));
        }
      }
    }
    return $topBar;
  }

  protected function buildMenu(array $data): OptionsMenu {
    $mb = new MenuBuilder();
    $mb->setCurrentUrl($this->activeURL);
    $menu = ResponsiveMenu::drilldownDropdown('large');
     $menu->setOption('back-button', htmlentities('<li class="js-drilldown-back"><a tabindex="0">Takaisin</a></li>', ENT_QUOTES));

    $menu = $mb->buildMenu($data, $menu);
    return $menu;
  }

  protected function buildLeft($param) {
    
  }

}
