<?php

/**
 * SplitButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;

/**
 * Class implements a Foundation 6 Split Button 
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Split Button 
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SplitButton extends AbstractContainerTag implements ButtonInterface {
  
  use ButtonTrait;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   * 
   * @param null|mixed|ButtonInterface $primary
   * @param null|mixed|ButtonInterface $secondary
   */
  public function __construct($primary = null, $secondary = null) {
    parent::__construct("div");
    $this->cssClasses()->lock("button-group");
    if (!($primary instanceof ButtonInterface)) {
      $primary = new Button("button", $primary);
    }
    $this->content()->set("primary", $primary);
    if (!($secondary instanceof ButtonInterface)) {
      $secondary = new ArrowOnlyButton();
    }
    $this->content()->set("secondary", $secondary);
  }

  /**
   * 
   * @return ButtonInterface
   */
  public function primaryButton() {
    return $this->content("primary");
  }

  /**
   * 
   * @return ButtonInterface
   */
  public function secondaryButton() {
    return $this->content("secondary");
  }

}
