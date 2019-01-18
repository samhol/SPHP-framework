<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;

/**
 * Implements a bullet container for Foundation Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Foundation Orbit slider
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BulletContainer extends AbstractComponent {

  /**
   *
   * @var Bullet[]
   */
  private $bullets = [];

  /**
   * Constructor
   *
   * @param  int $count slide(s)
   */
  public function __construct(int $count = 0) {
    parent::__construct('nav');
    for ($i = 0; $i < $count; $i++) {
      $this->setBullet($i);
    }
    $this->cssClasses()->protectValue('orbit-bullets');
  }

  /**
   * Sets a bullet pointing to a Orbit component
   *
   * @param  int|Bullet $bullet
   * @return $this for a fluent interface
   */
  public function setBullet($bullet) {
    if (!($bullet instanceof Bullet)) {
      $slideNo = $bullet;
      $bullet = new Bullet($slideNo);
    } else {
      $slideNo = $bullet->getSlideNo();
    }
    $this->bullets[$slideNo] = $bullet;
    return $this;
  }

  /**
   * Appends the given slide to the orbit component
   *
   * @param  int $slideNo
   * @return Bullet
   */
  public function getBullet(int $slideNo): Bullet {
    return $this->bullets[$slideNo];
  }

  /**
   * Sets the bullet of given index active
   *
   * @param  int $bulletNo
   * @return $this for a fluent interface
   */
  public function setActive(int $bulletNo) {
    foreach ($this->bullets as $no => $bullet) {
      if ($no == $bulletNo) {
        $bullet->setActive(true);
      } else {
        $bullet->setActive(false);
      }
    }
    return $this;
  }

  public function contentToString(): string {
    return implode('', $this->bullets);
  }

}
