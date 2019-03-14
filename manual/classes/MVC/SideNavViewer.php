<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\Content;
use Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

/**
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SideNavViewer implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var array 
   */
  private $data;

  /**
   * @var string 
   */
  private $currentPage;

  /**
   *
   * @var AccordionMenu 
   */
  private $nav;

  /**
   * Constructor
   * 
   * @param array $data
   * @param string $currentPage
   */
  public function __construct(array $data, string $currentPage = '') {
    $this->data = $data;
    $this->currentPage = $currentPage;
    $this->buildMenu();
  }

  /**
   * 
   * @return FlexibleMenu
   */
  public function getMenu(): FlexibleMenu {
    return $this->nav;
  }

  protected function buildMenu() {
    $this->nav = FlexibleMenu::createAccordion();
    $this->nav->appendText('Documentation');
    $builder = new MenuBuilder(new MenuLinkBuilder($this->currentPage));
    $builder->buildMenu($this->data, $this->nav);
  }

  public function getHtml(): string {
    return $this->nav->getHtml();
  }

}
