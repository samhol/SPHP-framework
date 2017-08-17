<?php

/**
 * AbstractHyperlinkIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Navigation\HyperlinkInterface;

/**
 * Description of HyperlinkIcon
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractHyperlinkIcon extends AbstractComponent implements HyperlinkInterface {

  use \Sphp\Html\ContentTrait;
  use \Sphp\Html\Navigation\HyperlinkTrait;

  /**
   *
   * @var AbstractIcon 
   */
  private $icon;

  /**
   * 
   * @param AbstractIcon $icon
   */
  public function __construct($href, AbstractIcon $icon, $target = null) {
    parent::__construct('a');
    $this->icon = $icon;
    $this->setHref($href);
    $this->setTarget($target);
    $this->cssClasses()->lock('brand-icon');
  }

  public function setIconName($iconName) {
    $this->icon->setIconName($iconName);
    return $this;
  }

  public function contentToString(): string {
    return $this->icon->getHtml();
  }

}
