<?php

/**
 * AbstractDbObject.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Sphp\Objects\AbstractArrayableObject;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class implements some common parts of AbstractItem interface.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractDbObject extends AbstractArrayableObject implements DbObjectInterface {

  public function existsIn(EntityManagerInterface $em) {
    echo "\n\nAbstractDbObject\n\n";
    return $em->contains($this);
  }

  public function isManagedBy(EntityManagerInterface $em) {
    return $em->contains($this);
  }

  public function replaceIn(EntityManagerInterface $em) {
    if (!$this->existsIn($em)) {
      $em->persist($this);
      $em->flush();
    }
    return $this->isManagedBy($em);
  }

  /**
   * 
   * @param EntityManagerInterface $em
   * @return $this;
   */
  public function insertAsNewInto(EntityManagerInterface $em) {
    $em->persist($this);
    $em->flush();
    return $this;
  }

  public function deleteFrom(EntityManagerInterface $em) {
    if ($em->contains($this)) {
      $em->remove($this);
      $em->flush();
    }
    return !$this->isManagedBy($em);
  }

}
