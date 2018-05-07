<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Database\Doctrine\Objects\DbObjectInterface;
use Sphp\Database\Exceptions\DatabaseException;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Abstract Implementation of a{@link DbObjectInterface} storage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractObjectStorage implements \IteratorAggregate, \Sphp\Stdlib\Datastructures\Arrayable, \ArrayAccess {

  /**
   * the type name of the stored objects
   *
   * @var string
   */
  private $type;

  /**
   * @var EntityManagerInterface 
   */
  private $em;

  /**
   * @var ObjectManager
   */
  private $repository;

  /**
   * Constructor
   *
   * @param string $objectType
   * @param EntityManagerInterface $em
   */
  public function __construct(string $objectType, EntityManagerInterface $em) {
    $this->type = $objectType;
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
  public function propNotUsed(string $prop, $value): bool {
    $query = $this->getManager()
            ->createQuery("SELECT COUNT(u.$prop) FROM " . $this->getObjectType() . " u WHERE u.$prop = :value");
    $query->setParameter('value', $value);
    $result = $query->getSingleScalarResult() == 0;
    return $result;
  }

  /**
   * Gets the repository for classes
   * 
   * @return ObjectRepository
   */
  public function getRepository(): ObjectRepository {
    return $this->repository;
  }

  /**
   * Returns the class name of the object managed by the repository
   * 
   * @return string
   */
  public function getObjectType(): string {
    return $this->type;
  }

  public function toArray(): array {
    return $this->getRepository()->findAll();
  }

  /**
   * Retrieves an external iterator
   * 
   * @return \Traversable an external iterator.
   */
  public function getIterator(): \Traversable {
    return new Collection($this->getRepository()->findAll());
  }

  /**
   * Counts objects of the repository
   * 
   * @return int number of objects of the repository
   */
  public function count(): int {
    return $this->getRepository()->count();
  }

  public function insertAsNew(DbObjectInterface $object): DbObjectInterface {
    try {
      $this->em->persist($object);
      $this->em->flush();
    } catch (\Exception $ex) {
      //echo 'foo';
      throw new DatabaseException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $object;
  }

  public function remove(DbObjectInterface $object) {
    $this->em->remove($object);
    $this->em->flush();
  }

  public function flush() {
    return $this->em->flush();
  }

  public function offsetExists($id): bool {
    return $this->getRepository()->find($id) !== null;
  }

  public function offsetGet($id) {
    return $this->getRepository()->find($id);
  }

  public function offsetSet($offset, $value) {
    throw new \Exception('fucked up!!!!!!');
  }

  public function offsetUnset($id) {
    $obj = $this->getRepository()->find($id);
    if ($obj !== null) {
      $this->remove($obj);
    }
  }

}
