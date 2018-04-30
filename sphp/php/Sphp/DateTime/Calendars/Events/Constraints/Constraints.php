<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Iterator;
use Sphp\DateTime\DateInterface;

/**
 * Description of Constraints
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Constraints implements Iterator, Constraint {

  /**
   * @var Constraint[] 
   */
  private $constraints = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->constraints = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->constraints);
  }

  public function isValidDate(DateInterface $date): bool {
    $result = true;
    foreach ($this->constraints as $constraint) {
      $result = $constraint->isValid($date);
      if ($result === false) {
        break;
      }
    }
    return $result;
  }

  public function append(Constraint $c) {
    $this->constraints[] = $c;
    return $this;
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->constraints);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->constraints);
  }

  /**
   * Return the key of the current constraint
   * 
   * @return mixed the key of the current constraint
   */
  public function key() {
    return key($this->constraints);
  }

  /**
   * Rewinds the Iterator to the first constraint
   */
  public function rewind() {
    reset($this->constraints);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->constraints);
  }

}
