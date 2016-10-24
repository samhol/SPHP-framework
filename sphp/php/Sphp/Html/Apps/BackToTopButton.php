<?php

/**
 * BackToTopButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Document;

/**
 * Class implements a back to top button for the web page
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-05-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BackToTopButton extends AbstractComponent {
  /**
   *
   * @var string 
   */
private $iconClasses;
  /**
   * Constructs a new instance
   *
   * @param string $title the title text of the button
   * @param string $iconClass css class names of the icon font style
   */
  public function __construct($title = 'Back to top', $iconClass = 'fa fa-chevron-circle-up') {
    parent::__construct('div');
    $this->cssClasses()->lock('sphp-back-to-top-button');
    $this->setTitle($title);
    $this->iconClasses = $iconClass;
  }

  public function contentToString() {
    return Document::icon($this->iconClasses)->getHtml();
  }

}
