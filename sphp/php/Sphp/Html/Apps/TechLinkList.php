<?php

/**
 * TechLinkList.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Stdlib\URL;
use Sphp\Html\Navigation\ImageLink;

/**
 * Class TechLinkList
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TechLinkList extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->lock('sphp-tech-list');
    $this->createContent();
  }

  /**
   * Creates the content of the component
   *
   * @return $this for a fluent interface
   */
  private function createContent() {
    $currentUrl = URL::getCurrent()->getHtml();
    $phpVersion = "PHP " . phpversion();
    $this->getInnerContainer()
            ->append((new ImageLink("http://validator.w3.org/check?uri=$currentUrl", "_blank", "sphp/pics/tech-icons/html5.png", "HTML5"))
                    ->setTitle("HTML5 validation"))
            ->append((new ImageLink("http://jigsaw.w3.org/css-validator/validator?uri=$currentUrl&profile=css3&usermedium=all&warning=1&vextwarning=&lang=en", "_blank", "sphp/pics/tech-icons/css3.png", "CSS3"))
                    ->setTitle("CSS3 validation"))
            ->append((new ImageLink("http://foundation.zurb.com/", "_blank", "sphp/pics/tech-icons/foundation.png", "Foundation"))
                    ->addCssClass("Foundation"))
            ->append((new ImageLink("http://www.php.net/", "_blank", "sphp/pics/tech-icons/php.png", $phpVersion))
                    ->setTitle($phpVersion))
            ->append((new ImageLink("http://jquery.com/", "_blank", "sphp/pics/tech-icons/jquery.png", "jQuery"))
                    ->setTitle("jQuery")
                    ->addCssClass("jQuery"));
    return $this;
  }

}
