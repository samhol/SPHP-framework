<?php

/**
 * Equalizer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Adapters;

use Sphp\Html\Adapters\AbstractComponentAdapter;
use Sphp\Html\ComponentInterface;

/**
 * Implements a Foundation Equalizer.
 *
 * Equalizer makes it dead simple to gives multiple items equal height.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Equalizer extends AbstractComponentAdapter {

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $equalizer
   * @param string|null $name
   */
  public function __construct(ComponentInterface $equalizer, $name = null) {
    parent::__construct($equalizer);
    if ($name === null) {
      $name = "eq_" . \Sphp\Stdlib\Strings::random();
    }
    $this->getComponent()->attrs()->lock('data-equalizer', $name);
  }

  /**
   * 
   * @return string
   */
  public function getEqualizerName() {
    return $this->getComponent()->attrs()->get('data-equalizer');
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * 
   * @param  string $screenSize
   * @return self for a fluent interface
   */
  public function equalizeOn($screenSize) {
    if ($screenSize != 'all') {
      $this->getComponent()->attrs()->set('data-equalize-on', $screenSize);
    } else {
      $this->getComponent()->attrs()->remove('data-equalize-on');
    }
    return $this;
  }

  /**
   * Sets/Unsets the Equalizer to match each row's items in height 
   * 
   * @param  boolean $flag
   * @return self for a fluent interface
   */
  public function equalizeByRow($flag = true) {
    if ($flag) {
      $this->getComponent()->attrs()->set('data-equalize-by-row', 'true');
    } else {
      $this->getComponent()->attrs()->remove('data-equalize-by-row');
    }
    return $this;
  }

  /**
   * Adds an observer
   * 
   * @param  ComponentInterface $observer
   * @return self for a fluent interface
   */
  public function addObserver(ComponentInterface $observer) {
    $observer->setAttr('data-equalizer-watch', $this->getEqualizerName());
    return $this;
  }

  /**
   * Removes an observer
   * 
   * @param  ComponentInterface $observer
   * @return self for a fluent interface
   */
  public function removeObserver(ComponentInterface $observer) {
    $observer->attrs()->remove('data-equalizer-watch');
    return $this;
  }

}
