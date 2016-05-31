<?php

/**
 * AbstractObjectStorage.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager as ObjectManager;
use Exception;
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
   * Constructor
   *
   * @param EntityManagerInterface $em
   */
  public function __construct($objectType, EntityManagerInterface $em = null) {
    $this->type = $objectType;
    $this->em = $em;
    $this->repository = $this->getManager()->getRepository($this->type);
  }

  /**
   * {@inheritdoc}
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

  /**
   * {@inheritdoc}
   */
  public function getObjectType() {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function findByProperty($prop, $value) {
    return $this->findBy([$prop => $value]);
  }

  /**
   * {@inheritdoc}
   */
  public function findBy(array $props) {
    return $this->getRepository()->findBy($props);
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new ArrayIterator($this->getRepository()->findAll());
  }

  /**
   * {@inheritdoc}
   */
  public function get($id) {
    return $this->getRepository()->find($id);
  }

  /**
   * {@inheritdoc}
   */
  public function exists($id) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function save(DbObjectInterface $object) {
    return $object->insertInto($this->em);
  }

  /**
   * {@inheritdoc}
   */
  public function delete(DbObjectInterface $object) {
    return $object->deleteFrom($this->em);
  }

  /**
   * {@inheritdoc}
   */
  public function contains(DbObjectInterface $object) {
    return $this->em->contains($object);
  }

}
