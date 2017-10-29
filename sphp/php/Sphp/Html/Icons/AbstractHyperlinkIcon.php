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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractHyperlinkIcon extends AbstractComponent implements HyperlinkInterface {

  use \Sphp\Html\ContentTrait;
  use \Sphp\Html\Navigation\HyperlinkTrait;

  /**
   * @var AbstractIcon 
   */
  private $icon;

  /**
   * Constructs a new instance
   * 
   * @param string $href
   * @param \Sphp\Html\Icons\AbstractIcon $icon
   * @param string $target
   */
  public function __construct(string $href, AbstractIcon $icon, string $target = null) {
    parent::__construct('a');
    $this->icon = $icon;
    $this->setHref($href);
    $this->setTarget($target);
    $this->cssClasses()->protect('brand-icon');
  }

  public function contentToString(): string {
    return $this->icon->getHtml();
  }

}
