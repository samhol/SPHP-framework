<?php

/**
 * BulletContainer.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractContainerComponent;

/**
 * Implements a bullet container for Foundation Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Orbit slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BulletContainer extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * @param  int $count slide(s)
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($count = 0) {
    parent::__construct('nav');
    for ($i = 0; $i < $count; $i++) {
      $this->set($i);
    }
    $this->cssClasses()->lock('orbit-bullets');
  }

  /**
   * Sets a bullet pointing to a Orbit component
   *
   * @param  int|Bullet $bullet
   * @return self for PHP Method Chaining
   */
  public function set($bullet) {
    if (!($bullet instanceof Bullet)) {
      $slideNo = $bullet;
      $bullet = new Bullet($slideNo);
    } else {
      $slideNo = $bullet->getSlideNo(); 
    }
    $this->getInnerContainer()->set($slideNo, $bullet);
    return $this;
  }

  /**
   * Appends the given slide to the orbit component
   *
   * @param  int $slideNo
   * @return Bullet
   */
  public function get($slideNo) {
    $this->getInnerContainer()->get($slideNo);
    return $this;
  }

  /**
   * Sets the bullet of given index active
   *
   * @param  int $bulletNo
   * @return self for PHP Method Chaining
   */
  public function setActive($bulletNo) {
    foreach ($this->getInnerContainer() as $no => $bullet) {
      if ($no == $bulletNo) {
        $bullet->setActive(true);
      } else {
        $bullet->setActive(false);
      }
    }
    return $this;
  }

}
