<?php

/**
 * Addresses.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Addresses extends AbstractObjectStorage {

  /**
   * Constructs a new instance
   *
   * @param EntityManagerInterface $em
   */
  public function __construct(EntityManagerInterface $em) {
    parent::__construct(Address::class, $em);
  }

  /**
   * 
   * @param  string $country
   * @return Address[]
   */
  public function getByCountry($country) {
    return $this->findByProperty("country", $country);
  }

}
