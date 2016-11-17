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
    return $this->em->getRepository($this->type);
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

  public function findAll() {
    return $this->getRepository()->findAll();
  }

  public function getIterator() {
    return new ArrayIterator($this->getRepository()->findAll());
  }

  public function get($id) {
    return $this->getRepository()->find($id);
  }

  public function count() {
    $query = $this->em->createQuery("SELECT COUNT(t.id) FROM $this->type t");
    $count = $query->getSingleScalarResult();
    return (int) $count;
  }

  public function save(DbObjectInterface $object) {
    if (!$this->contains($object)) {
      $this->em->persist($object);
    }
    $this->em->flush();
    return true;
  }

  public function merge(DbObjectInterface $object) {
    return $this->em->merge($object);
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

}
