<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;

/**
 * Description of Note
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Note extends AbstractNote {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param DateInterface $date 
   * @param string $name
   * @param string $description
   */
  public function __construct(DateInterface $date, string $name, string $description = null) {
    parent::__construct($name, $description);
    $this->date = $date;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
    parent::__destruct();
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return $this->date->matchesWith($date);
  }

}
