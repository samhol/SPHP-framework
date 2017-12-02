<?php

/**
 * AbstractObjectStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ArrayIterator;
use Sphp\Database\Doctrine\EntityManagerFactory;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Database\Doctrine\Objects\DbObjectInterface;

/**
 * Abstract Implementation of a{@link DbObjectInterface} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractObjectStorage implements \IteratorAggregate, ObjectStorageInterface {

  /**
   * the type name of the stored objects
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
  public function __construct(string $objectType, EntityManagerInterface $em = null) {
    $this->type = $objectType;
    if ($em === null) {
      $em = EntityManagerFactory::get();
    }
    $this->em = $em;
    $this->repository = $this->em->getRepository($this->type);
  }

  /**
   * Returns the entity manager
   * 
   * @return EntityManagerInterface
   */
  public function getManager(): EntityManagerInterface {
    return $this->em;
  }

  public function query(): \Doctrine\ORM\QueryBuilder {
    return $this->em->createQueryBuilder();
  }

  /**
   * Confirms the uniqueness of the location name in the repository
   *
   * @param  string $needle the location instance or the location name string
   * @return boolean true, if field value is unique, false otherwise
   */
  public function valueNotUsed(string $prop, $value): bool {
    $query = $this->getManager()
            ->createQuery("SELECT COUNT(u.$prop) FROM " . $this->getObjectType() . " u WHERE u.$prop = :value");
    $query->setParameter('value', $value);
    $result = $query->getSingleScalarResult() == 0;
    return $result;
  }

  /**
   * 
   * @return ObjectManager
   */
  public function getRepository() {
    return $this->repository;
  }

  public function getObjectType(): string {
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

  public function getIterator(): \Traversable {
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

  public function count(): int {
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

  public function contains(DbObjectInterface $object): bool {
    return $this->em->contains($object);
  }

  public function flush() {
    return $this->em->flush();
  }

}
