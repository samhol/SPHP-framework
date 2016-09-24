<?php

/**
 * BackToTopButton.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Img;

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
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct("div");
    $this->cssClasses()->lock("sphp-back-to-top-button");
    $this->setTitle("Back to top");
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return (new Img("sphp/pics/back-to-top.png", "Back to top"))->getHtml();
  }

}
