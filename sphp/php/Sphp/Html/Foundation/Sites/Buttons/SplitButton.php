<?php

/**
 * SplitButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;

/**
 * Implements a Foundation 6 Split Button 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button-group.html#split-buttons Foundation 6 Split Button 
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SplitButton extends AbstractComponent implements ButtonInterface {

  use ButtonTrait;

  /**
   * the primary button
   *
   * @var ButtonInterface 
   */
  private $primary;

  /**
   * the secondaty button
   *
   * @var ButtonInterface 
   */
  private $secondary;

  /**
   * Constructs a new instance
   * 
   * @param null|mixed|ButtonInterface $primary
   * @param ArrowOnlyButton $secondary
   */
  public function __construct($primary = null, ArrowOnlyButton $secondary = null) {
    parent::__construct('div');
    $this->cssClasses()->lock('button-group');
    if (!($primary instanceof ButtonInterface)) {
      $primary = new Button('button', $primary);
    }
    $this->primary = $primary;
    if ($secondary === null) {
      $secondary = new ArrowOnlyButton($secondary);
    }
    $this->secondary = $secondary;
  }

  public function __destruct() {
    unset($this->primary, $this->secondary);
    parent::__destruct();
  }

  /**
   * Returns the primary button
   * 
   * @return ButtonInterface the primary button
   */
  public function primaryButton() {
    return $this->primary;
  }

  /**
   * Returns the secondaty button
   * 
   * @return ButtonInterface the secondaty button
   */
  public function secondaryButton() {
    return $this->secondary;
  }

  public function contentToString() {
    return $this->primary . $this->secondary;
  }

}
