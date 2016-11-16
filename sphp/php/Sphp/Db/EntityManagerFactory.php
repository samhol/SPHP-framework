<?php

/**
 * EntityManagerFactory.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Db;

use InvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Proxy\ProxyFactory;
use Doctrine\ORM\Query\FilterCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManager;

/**
 * Obtains a singelton {@link Database} instance for the given database connection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @update 2011-03-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EntityManagerFactory {

  private static $params = [];

  /**
   * Factory method to create EntityManager instances.
   *
   * @param  mixed $conn An array with the connection parameters or an existing Connection instance.
   * @param  Configuration $config The Configuration instance to use.
   * @param  EventManager  $eventManager The EventManager instance to use.
   * @throws InvalidArgumentException
   * @throws ORMException
   */
  public static function setDefaults($conn, Configuration $config, EventManager $eventManager = null) {
    self::setParameters(0, $conn, $config, $eventManager);
  }

  /**
   * Factory method to create EntityManager instances.
   *
   * @param  string $name the name of the parameter set provided for the entity managers
   * @param  mixed $conn An array with the connection parameters or an existing Connection instance.
   * @param  Configuration $config The Configuration instance to use.
   * @param  EventManager  $eventManager The EventManager instance to use.
   * @throws InvalidArgumentException
   * @throws ORMException
   */
  public static function setParameters($name, $conn, Configuration $config, EventManager $eventManager = null) {
    self::$params[$name]['conn'] = $conn;
    self::$params[$name]['config'] = $config;
    self::$params[$name]['eventManager'] = $eventManager;
  }

  /**
   * Obtains a singelton new {@link EntityManager} instance for given database connection
   *
   * @param  mixed         $conn         An array with the connection parameters or an existing Connection instance.
   * @param  Configuration $config       The Configuration instance to use.
   * @param  EventManager  $eventManager The EventManager instance to use.
   * @return EntityManager the object that represents a connection to a database server
   * @throws \PDOException if there is no database connection or query execution fails
   * @throws InvalidArgumentException
   * @throws ORMException
   * @link   http://www.php.net/manual/en/book.pdo.php PHP Data Objects
   * @link   http://www.php.net/manual/en/pdo.construct.php \PDO::__construct
   */
  public static function get($name = 0) {
    if (!array_key_exists($name, self::$params)) {
      throw new InvalidArgumentException;
    }
    return EntityManager::create(self::$params[$name]['conn'], self::$params[$name]['config'], self::$params[$name]['eventManager']);
  }

}
