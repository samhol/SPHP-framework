<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Adapters\TipsoAdapter;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of MenuLinkBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MenuLinkBuilder {

  /**
   * @var string 
   */
  private $defaultTarget = null;

  /**
   * @var string 
   */
  private $currentPage;

  /**
   *
   * @var callable|null 
   */
  private $activator;

  //public function set

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
   * @param  callable $activator
   * @return $this
   */
  public function setActivator(callable $activator) {
    $this->activator = $activator;
    return $this;
  }

  /**
   * 
   * 
   * @param array $linkData
   * @return string
   * @throws InvalidArgumentException
   */
  protected function parseHref(array $linkData): string {
    if (array_key_exists('href', $linkData)) {
      $href = $linkData['href'];
    } else {
      throw new InvalidArgumentException('href is missing');
    }
    return $href;
  }

  /**
   * 
   * @param  array $linkData
   * @return string|null
   */
  protected function parseTarget(array $linkData): ?string {
    return array_key_exists('target', $linkData) ? $linkData['target'] : null;
  }

  /**
   * 
   * 
   * @param  array $linkData
   * @return string
   * @throws InvalidArgumentException
   */
  public function pareLinkText(array $linkData): string {
    if (!array_key_exists('link', $linkData)) {
      throw new InvalidArgumentException("Malformed link data given");
    }
    $text = '';
    if (array_key_exists('icon', $linkData)) {
      $text .= $linkData['icon'] . ' ';
    }
    $text .= $linkData['link'];
    return $text;
  }

  public function setTipso() {
    
  }

  /**
   * Creates a new menu link object from data
   * 
   * @param  array $linkData
   * @return MenuLink parsed menu link object
   */
  public function parseLink(array $linkData): MenuLink {
    $href = $this->parseHref($linkData);
    $target = $this->parseTarget($linkData);
    $linkText = $this->pareLinkText($linkData);
    $link = new MenuLink($href, $linkText, $target);
    if (is_callable($this->activator)) {
      $t = $this->getActivator();
      $link->setActive($t($linkData));
    }
    if (array_key_exists('tipso', $linkData)) {
      new TipsoAdapter($link, $linkData['tipso']);
    }
    return $link;
  }

  public function adapters(MenuLink $link, $linkData) {
    
  }

}
