<?php

/**
 * AbstractObjectStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ArrayIterator;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractObjectStorage implements ObjectStorageInterface {

  /**
   *
   * @var string
   */
  private $type;

  /**
   *
   * @var EntityManagerInterface 
   */
  private $em;

  /**
   *
   * @var ObjectManager
   */
  private $repository;

  /**
   * Constructs a new instance
   *
   * @param string $objectType
   * @param EntityManagerInterface $em
   */
  public function __construct($objectType, EntityManagerInterface $em) {
    $this->type = $objectType;
    $this->em = $em;
    $this->repository = $this->getManager()->getRepository($this->type);
  }

  /**
   * Returns the entity Nameger 
   * 
   * @return EntityManagerInterface
   */
  public function getManager() {
    return $this->em;
  }

  /**
   * 
   * @return ObjectManager
   */
  public function getRepository() {
    return $this->repository;
  }

  public function getObjectType() {
    return $this->type;
  }

  public function findByProperty($prop, $value) {
    return $this->findBy([$prop => $value]);
  }

  public function findBy(array $props) {
    return $this->getRepository()->findBy($props);
  }

  public function getIterator() {
    return new ArrayIterator($this->getRepository()->findAll());
  }

  public function get($id) {
    return $this->getRepository()->find($id);
  }

  public function exists($id) {
    $query = $this->getManager()
            ->createQuery('SELECT COUNT(obj.id) FROM ' . $this->getObjectType() . " obj WHERE obj.id = :id");
    $query->setParameter('id', $id);
    return $query->getSingleScalarResult() == 1;
  }

  public function count() {
    $query = $this->em->createQuery("SELECT COUNT(t.id) FROM $this->type t");
    $count = $query->getSingleScalarResult();
    return (int) $count;
  }

  public function save(DbObjectInterface $object) {
    return $object->insertAsNewInto($this->em);
  }

  public function delete(DbObjectInterface $object) {
    return $object->deleteFrom($this->em);
  }

  public function contains(DbObjectInterface $object) {
    return $this->em->contains($object);
  }

}
