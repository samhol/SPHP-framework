<?php

/**
 * DbObjectInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine;

use Sphp\Objects\ArrayableObjectInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines common features for all database objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DbObjectInterface extends ArrayableObjectInterface {

  /**
   * Resets all the member values from a given raw data source
   *
   * @param  mixed[] $data raw source data
   * @return $this for a fluent interface
   */
  public function fromArray(array $data = []);

  /**
   * Inserts the user as a new instance to the database
   *
   * @param  EntityManagerInterface $em the entity manager
   * @return boolean true if the operation was succesfull, false otherwise
   */
  public function isManagedBy(EntityManagerInterface $em);

  /**
   * Inserts the user as a new instance to the database
   *
   * @param  EntityManagerInterface $em the entity manager
   * @return boolean true if the operation was succesfull, false otherwise
   */
  public function insertAsNewInto(EntityManagerInterface $em);

  /**
   * Inserts the user as a new instance to the database
   *
   * @param  EntityManagerInterface $em the entity manager
   * @return boolean true if the operation was succesfull, false otherwise
   */
  public function deleteFrom(EntityManagerInterface $em);
}
