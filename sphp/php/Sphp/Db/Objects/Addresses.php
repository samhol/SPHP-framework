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
   * Finds all managed {@link Address} objects that have the same country
   * 
   * @param  string $country the name of the country
   * @return Address[] all managed objects that have the same country
   */
  public function findAllByCountry($country) {
    return $this->findByProperty("country", $country);
  }

}
