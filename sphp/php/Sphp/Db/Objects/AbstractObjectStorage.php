<?php

/**
 * AbstractObjectStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ArrayIterator;
use Sphp\Db\EntityManagerFactory;
use Sphp\Data\Collection;

/**
 * Abstract Implementation of a{@link DbObjectInterface} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractObjectStorage implements ObjectStorageInterface {

  /**
   * the typename of the stored objects
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
  public function __construct($objectType, EntityManagerInterface $em = null) {
    $this->type = $objectType;
    if ($em === null) {
      $em = EntityManagerFactory::get();
    }
    $this->em = $em;
    $this->repository = $this->em->getRepository($this->type);
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

  public function findByProperty($prop, $value, array $orderBy = null, $limit = null, $offset = null) {
    return $this->findBy([$prop => $value], $orderBy, $limit, $offset);
  }

  public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
    return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
  }

  public function findAll() {
    return $this->getRepository()->findAll();
  }

  public function getIterator() {
    return new ArrayIterator($this->getRepository()->findAll());
  }

  public function getById($id) {
    if ($id instanceof DbObjectInterface) {
      $id = $id->getPrimaryKey();
    }
    return $this->getRepository()->find($id);
  }
  public function get($limit = null, $offset = null, array $orderBy = null) {
    return new Collection($this->getRepository()->findBy([], $orderBy, $limit, $offset));
  }
  public function count() {
    $query = $this->em->createQuery("SELECT COUNT(t.id) FROM $this->type t");
    $count = $query->getSingleScalarResult();
    return (int) $count;
  }

  public function insertAsNew(DbObjectInterface $object) {
    if (!$this->contains($object)) {
      $this->em->persist($object);
    }
    $this->em->flush();
    return true;
  }

  public function merge(DbObjectInterface $object) {
    $obj = $this->em->merge($object);
    return $obj;
  }

  public function delete(DbObjectInterface $object) {
    return $object->deleteFrom($this->em);
  }

  public function clear() {
    foreach ($this->getRepository()->findAll() as $obj) {
      $this->em->remove($obj);
    }
    $this->em->flush();
    return $this;
  }

  public function contains(DbObjectInterface $object) {
    return $this->em->contains($object);
  }

  public function flush() {
    return $this->em->flush();
  }

}
