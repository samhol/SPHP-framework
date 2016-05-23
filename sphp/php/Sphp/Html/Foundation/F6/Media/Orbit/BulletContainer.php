<?php

/**
 * Orbit.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use	Sphp\Html\Container as Container;

/**
 * Class implements a Foundation Orbit containing {@link Slide} components
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Orbit slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @deprecated since version 2.0.0
 */
class BulletContainer extends AbstractComponent {

	/**
	 * Constructs a new instance
	 *
	 * **Notes:**
	 *
	 * 1. `mixed $slides` can be of any type that converts to a PHP string
	 * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
	 * 3. All items of an array are treated according to note (2)
	 *
	 * @param  int $count slide(s)
	 * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
	 */
	public function __construct($count = 0) {
		parent::__construct("nav");
		for ($i = 0; $i < $count; $i++) {
			$this->set($i);
		}
		$this->cssClasses()->lock("orbit-bullets");
	}

	/**
	 * Sets a bulletpointing to a Orbit component
	 *
	 * @param  int $slideNo
	 * @return self for PHP Method Chaining
	 */
	public function set($slideNo) {
		$this->content()->set($slideNo, new Bullet($slideNo));
		return $this;
	}

	/**
	 * Appends the given slide to the orbit component
	 *
	 * @param  int $slideNo
	 * @return Bullet
	 */
	public function get($slideNo) {
		$this->content()->get($slideNo);
		return $this;
	}

	/**
	 * Appends a new slide component to the orbit component
	 *
	 * @param  int $bulletNo
	 * @return self for PHP Method Chaining
	 */
	public function setActive($bulletNo) {
    foreach ($this->content() as $no => $bullet) {
      if ($no == $bulletNo) {
        $bullet->setActive(true);
      } else {
        $bullet->setActive(false);
      }
    }
		return $this;
	}

}
