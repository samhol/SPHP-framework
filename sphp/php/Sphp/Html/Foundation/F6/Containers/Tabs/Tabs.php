<?php

/**
 * Tabs.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\Div as Div;

/**
 * Class implements Foundation Tabs in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tabs implements \Sphp\Html\ContentInterface  {
  
  use \Sphp\Html\ContentTrait;
  
  /**
   *
   * @var TabContentContainer 
   */
  private $tabs;
  
  /**
   *
   * @var TabContentContainer 
   */
  private $tabsContent;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->tabsContent = new TabContentContainer();
    //$this->tabs = $this->tabsContent->getTabButtons();
  }

  /**
   * Returns the inner tabs container
   *
   * @return Tab the inner tabs container
   */
  protected function getTabs() {
    return $this->tabs;
  }

  /**
   * Returns the inner tabs content container
   *
   * @return Div the inner tabs content container
   */
  protected function getContainer() {
    return $this->tabsContent;
  }

  /**
   * Adds a new tab into the container
   *
   * @param  mixed $tab the label of the tab
   * @param  mixed $content the content of the tab
   * @return self for PHP Method Chaining
   */
  public function addTab($tab, $content) {
    $this->tabsContent->append(new Tab($tab, $content));
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function getHtml() {
    //echo $this->tabsContent;
    return $this->tabsContent->getTabButtons() . $this->tabsContent;
  }
  
  /**
   * 
   * @param  boolean $match
   * @return self for PHP Method Chaining
   */
  public function matchHeight($match = true) {
    $this->getContainer()->matchHeight($match);
    return $this;
  }

}
