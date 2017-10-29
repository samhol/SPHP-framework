<?php

/**
 * BackToTopButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\ContentInterface;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Icons\AbstractIcon;

/**
 * Implements a back to top button for the web page
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BackToTopButton implements ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * @var ComponentInterface 
   */
  private $component;

  /**
   * Constructs a new instance
   *
   * @param string $title the title text of the button
   * @param string $iconClass CSS class names of the icon font style
   */
  public function __construct(ComponentInterface $component) {
    $component->attrs()->demand('data-sphp-back-to-top-button');
    $this->component = $component;
  }

  public function getComponent(): ComponentInterface {
    return $this->component;
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

  public static function fromIcon(AbstractIcon $icon): BackToTopButton {
    $icon->cssClasses()->protect('sphp-back-to-top-button');
    return new static($icon);
  }

}
