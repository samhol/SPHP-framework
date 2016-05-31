<?php

/**
 * ObservableSubjectTrait.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use SplObserver;

/**
 * Trait implements the {@link SplSubject} class in observer pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ObservableSubjectTrait {

	/**
	 * collection of individual observer objects
	 *
	 * @var \SplObjectStorage
	 */
	protected $observers;

	/**
	 * Attach an observer to the observable
	 *
	 * @param SplObserver $obs the attached observer
	 */
	public function attach(SplObserver $obs) {
		if ($this->observers === null) {
			$this->observers = new \SplObjectStorage();
		}
		$this->observers->attach($obs);
	}

	/**
	 * Detaches an observer from the observable
	 *
	 * @param SplObserver $obs the detached observer
	 */
	public function detach(SplObserver $obs) {
		$this->observers->detach($obs);
	}

	/**
	 * Notifies all {@link SplObserver} observers
	 */
	public function notify() {
		if ($this->observers !== null) {
			foreach ($this->observers as $obs) {
				$obs->update($this);
			}
		}
	}

}
