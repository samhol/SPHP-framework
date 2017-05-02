<?php

/**
 * HyperlinkIcon.php (UTF-8)
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
class HyperlinkIcon extends AbstractHyperlinkIcon {

  use \Sphp\Html\ContentTrait;
  use \Sphp\Html\Navigation\HyperlinkTrait;

  /**
   * 
   * @param string $iconName
   */
  public function __construct($url, $iconName, $target = null) {
    if (!$iconName instanceof AbstractIcon) {
      $iconName = new Icon($iconName);
    }
    parent::__construct($url, $iconName, $target);
    //$this->setHref($url);
  }

}
