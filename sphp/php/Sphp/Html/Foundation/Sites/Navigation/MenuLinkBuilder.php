<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Stdlib\Path;

/**
 * Description of MenuLinkBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MenuLinkBuilder {

  /**
   * @var type 
   */
  private $defaultTarget = null;

  /**
   * @var type 
   */
  private $currentPage;

  /**
   *
   * @var callable|null 
   */
  private $activator;

  /**
   *
   * @var string 
   */
  private $menuType = Menu::class;

  public function __construct() {
    ;
  }

  /**
   * 
   * @param  string $target
   * @return $this for a fluent interface
   */
  public function setMenuType(string $target) {
    $this->menuType = $target;
    return $this;
  }

  /**
   * 
   * @return type
   */
  public function getCurrentPage() {
    return $this->currentPage;
  }

  /**
   * 
   * @param type $currentPage
   * @return $this
   */
  public function setCurrentPage($currentPage) {
    $this->currentPage = $currentPage;
    return $this;
  }

  /**
   * 
   * @param  string $target
   * @return $this for a fluent interface
   */
  public function setDefaultTarget($target) {
    $this->defaultTarget = $target;
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getDefaultTarget() {
    return $this->defaultTarget;
  }

  public function getActivator() {
    return $this->activator;
  }

  /**
   * 
   * @param type $activator
   * @return $this
   */
  public function setActivator($activator) {
    $this->activator = $activator;
    return $this;
  }

  /**
   * 
   * @param  array $linkData
   * @return string
   */
  protected function parseHref(array $linkData): string {
    if (array_key_exists('href', $linkData)) {
      $href = $linkData['href'];
    } else {
      $href = Path::get()->http();
    }
    return $href;
  }

  /**
   * 
   * @param  array $linkData
   * @return string
   */
  protected function parseTarget(array $linkData) {
    return array_key_exists('target', $linkData) ? $linkData['target'] : $this->getDefaultTarget();
  }

  /**
   * 
   * @param  array $linkData
   * @return MenuLink
   */
  public function parseLink(array $linkData): MenuLink {
    $href = $this->parseHref($linkData);
    $target = $this->parseTarget($linkData);
    $link = new MenuLink($href, $linkData['link'], $target);
    if (is_callable($this->activator)) {
      $t = $this->getActivator();
      $link->setActive($t($linkData));
    }
    return $link;
  }

}
