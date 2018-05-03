<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime;

/**
 * Description of Month
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Month extends AbstractDateTimeTag {
  
  public function setDateTime(\DateTimeInterface $dateTime) {   
    $this->attributes()->set('datetime', (string) $dateTime->format('Y-m'));
    $this->dateTime = $dateTime;
    return $this;
  }

}
