<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Factory;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Foundation\Sites\Navigation\MenuLink;

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
  private $currentPage;

  /**
   *
   * @var callable|null 
   */
  private $activator;

  /**
   * 
   * 
   * @return string|null
   */
  public function getActiveURL(): ?string {
    return $this->currentPage;
  }

  /**
   * 
   * 
   * @param  string|null $currentPage
   * @return $this
   */
  public function setActiveURL(string $currentPage = null) {
    $this->currentPage = $currentPage;
    return $this;
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
   * @param  array $linkData
   * @return string
   * @throws InvalidArgumentException
   */
  protected function parseHref(array $linkData): string {
    if (array_key_exists('href', $linkData)) {
      $href = $linkData['href'];
    } else {
      throw new InvalidArgumentException('Link href value is missing from link data');
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
   * @param  array $linkData
   * @return string|null
   */
  protected function parseRelation(array $linkData): ?string {
    return array_key_exists('rel', $linkData) ? $linkData['rel'] : null;
  }

  /**
   * 
   * 
   * @param  array $linkData
   * @return string
   * @throws InvalidArgumentException
   */
  public function pareLinkText(array $linkData): string {
    if (!array_key_exists('text', $linkData)) {
      throw new InvalidArgumentException("Malformed link data given");
    }
    $text = '';
    if (array_key_exists('fa-icon', $linkData)) {
      $fa = new \Sphp\Html\Media\Icons\FontAwesome();
      $icon = $fa->createIcon($linkData['fa-icon']);
      $text .= $icon . ' ';
    }
    $text .= $linkData['text'];
    return $text;
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
    if ($this->currentPage === $href) {
      $link->setActive(true);
    }
    return $link;
  }

}
