<?php

/**
 * MenuLinkBuilder.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\Foundation\Sites\Navigation\MenuLinkBuilder as SphpMenuLinkBuilder;
use Sphp\Html\Foundation\Sites\Navigation\MenuLink;

/**
 * Description of MenuBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuLinkBuilder extends SphpMenuLinkBuilder {

  /**
   *
   * @var string|null
   */
  private $currentPage;

  /**
   * Construct a new instance
   * 
   * @param string $currentPage
   */
  public function __construct(string $currentPage = null) {
    parent::__construct();
    $this->currentPage = $currentPage;
  }

  public function parseLink(array $linkData): MenuLink {
    $link = parent::parseLink($linkData);
    if (array_key_exists('href', $linkData) && $this->currentPage === $linkData['href']) {
      $link->setActive(true);
    }
    return $link;
  }

}
