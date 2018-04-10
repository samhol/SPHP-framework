<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database\Doctrine;

use InvalidArgumentException;
use Doctrine\ORM\ORMException;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * A factory for creating {@link EntityManager} instances
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @update  2016-03-08
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EntityManagerFactory {

  /**
   *
   * @var mixed[] 
   */
  private static $params = [];

  /**
   * Parameter setter for default {@link EntityManager} instances
   *
   * @param  mixed $conn An array with the connection parameters or an existing Connection instance.
   * @param  Configuration $config The Configuration instance to use.
   * @param  EventManager $eventManager The EventManager instance to use
   */
  public static function setDefaults($conn, Configuration $config, EventManager $eventManager = null) {
    self::setParameters(0, $conn, $config, $eventManager);
  }

  /**
   * Parameter setter for named {@link EntityManager} instances
   *
   * @param  string $name the name of the parameter set provided for the entity managers
   * @param  mixed $conn An array with the connection parameters or an existing Connection instance
   * @param  Configuration $config The Configuration instance to use
   * @param  EventManager $eventManager The EventManager instance to use
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
      throw new \InvalidArgumentException('Manager not found');
    }
    return EntityManager::create(self::$params[$name]['conn'], self::$params[$name]['config'], self::$params[$name]['eventManager']);
  }

}
