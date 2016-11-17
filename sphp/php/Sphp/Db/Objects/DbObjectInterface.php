<?php

/**
 * DbObjectInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Objects\ArrayableObjectInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines common features for all database objects.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface DbObjectInterface extends ArrayableObjectInterface {

  /**
   * Returns the unique id (database table's primary key)
   *
   * @return mixed the unique id (database table's primary key)
   */
  public function getPrimaryKey();

  /**
   * Sets the unique id (database table's primary key)
   *
   * @param  mixed $key the unique id (database table's primary key)
   * @return self for PHP Method Chaining
   */
  public function setPrimaryKey($key);

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
