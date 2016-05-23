<?php

/**
 * PrioritizedObjectStorage.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

/**
 * A map from prioritized objects to data 
 * 
 * Class provides a map from objects with priorities to data or, by ignoring data, 
 * an object set. This dual purpose can be useful in many cases involving the need 
 * to uniquely identify objects.
 * 
 * Objects with equal priority value occur in the order in which they were inserted.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @version 1.0.0
 * @link    http://php.net/manual/en/class.splobjectstorage.php The SplObjectStorage class
 * @link    http://php.net/manual/en/class.splpriorityqueue.php the SplPriorityQueue class
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PrioritizedObjectStorage implements \IteratorAggregate, \Countable {

	/**
	 * the inner priority queue
	 *
	 * @var StablePriorityQueue 
	 */
	private $queue;

	/**
	 * the inner object set
	 * 
	 * @var \SplObjectStorage 
	 */
	private $set;

	/**
	 * Constructs a new instance
	 */
	public function __construct() {
		$this->set = new \SplObjectStorage();
		$this->queue = new StablePriorityQueue();
	}

	/**
	 * Destroys the instance
	 * 
	 * The destructor method will be called as soon as there are no other references 
	 * to a particular object, or in any order during the shutdown sequence.
	 */
	public function __destruct() {
		unset($this->set, $this->queue);
	}

	/**
	 * Clones the object
	 *
	 * **Note:** Method cannot be called directly!
	 *
	 * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
	 */
	public function __clone() {
		$this->set = clone $this->set;
		$this->rearrange();
	}
	
	/**
	 * Inserts an object in the storage
	 * 
	 * @param  \object $object the object to add
	 * @param  mixed $priority the associated priority
	 * @param  mixed $data the data to associate with the object
	 * @return self for PHP Method Chaining
	 */
	public function insert($object, $priority = 0, $data = null) {
		$objData = [
			"data" => $data,
			"priority" => $priority
		];
		if ($this->set->contains($object)) {
			$this->set->attach($object, $objData);
			$this->rearrange();
		} else {
			$this->set->attach($object, $objData);
			$this->queue->insert($object, $priority);
		}
		return $this;
	}
	
	public function remove($object) {
		if ($this->set->contains($object)) {
			$this->set->detach($object);
			$this->rearrange();
		}
		return $this;
	}

	/**
	 * Rearranges the objects according to the priorities
	 * 
	 * @return self for PHP Method Chaining
	 */
	protected function rearrange() {
		$this->queue = new StablePriorityQueue();
		foreach ($this->set as $obj) {
			$this->queue->insert($obj, $this->set->offsetGet($obj));
		}
		return $this;
	}

	/**
	 * Returns the priority value of the given object
	 * 
	 * @param  \object $object
	 * @return mixed the priority value of the given object
	 */
	public function getPriority($object) {
		if ($this->set->contains($object)) {
			return $this->set->offsetGet($object)["priority"];
		} else {
			return null;
		}
	}

	/**
	 * Returns the data associated with an object
	 * 
	 * @param  \object $object the object to look for
	 * @return mixed the data previously associated with the object in the storage
	 */
	public function getdData($object) {
		return $this->set->offsetGet($object)["data"];
	}

	/**
	 * Checks if the storage contains a specific object
	 * 
	 * @param  \object $object
	 * @return boolean true if the object is in the storage, false otherwise
	 */
	public function contains($object) {
		return $this->set->contains($object);
	}

	/**
	 * Extracts the object with the highest priority from the storage
	 * 
	 * @return \object
	 */
	public function extract() {
		$object = $this->queue->extract();
		$this->set->detach($object);
		return $object;
	}

	/**
	 * Returns the number of objects in the storage
	 * 
	 * @return int the number of objects in the storage
	 */
	public function count() {
		return $this->set->count();
	}

	/**
	 * 
	 * @return \ArrayIterator
	 */
	public function getIterator() {
		$arr = new \ArrayIterator();
		foreach (clone $this->queue as $obj) {
			$arr[] = $obj;
		}
		return $arr;
	}

}
