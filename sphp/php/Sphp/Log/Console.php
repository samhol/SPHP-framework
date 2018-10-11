<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Log;

use Sphp\Html\Scripts\ScriptCode;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Parsers\Parser;

/**
 * Implements PHP message outputting To Browser Console
 * 
 * @method void log(mixed $message) Logs error message to browser console
 * @method void info(mixed $message) Logs error message to browser console
 * @method void warn(mixed $message) Logs error message to browser console
 * @method void error(mixed $message) Logs error message to browser console
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Console {

  const LOG = 'log';
  const INFO = 'info';
  const WARN = 'warn';
  const ERROR = 'error';
  const TABLE = 'table';

  /**
   * @var string[] 
   */
  private static $types = [self::LOG, self::INFO, self::WARN, self::ERROR, self::TABLE];

  /**
   *
   * @var string[] 
   */
  private $rows = [];

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments) {
    if (!in_array($name, static::$types)) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $message = array_shift($arguments);
    if ($message === null) {
      throw new \Sphp\Exceptions\InvalidArgumentException("Method $name does not exist");
    }
    $obj = new static();
    $obj->add($name, $message);
    $obj->run()->clear();
  }

  protected function createLog(string $type, $data) {
    if (is_array($data)) {
      $data = Parser::json()->write($data);
      //echo "console.$type($data);";
    } else if (is_string($data)) {
      $data = "'$data'";
    }
    return "console.$type($data);";
  }

  /**
   * 
   * @param  string $type
   * @param  mixed $logText
   * @return $this for a fluent interface
   */
  public function add(string $type, $logText) {
    $this->rows[] = ['type' => $type, 'message' => $logText];
    return $this;
  }

  public function addLog(string $logText) {
    $this->add(self::LOG, $logText);
    return $this;
  }

  public function run() {
    if (empty($this->rows)) {
      return $this;
    }
    $js = 'if (!window.console) console = {};';
    $js .= 'console.log = console.log || function(){};';
    $js .= 'console.warn = console.warn || function(){};';
    $js .= 'console.error = console.error || function(){};';
    $js .= 'console.info = console.info || function(){};';
    $js .= 'console.debug = console.debug || function(){};';
    $scriptTag = new ScriptCode();
    $scriptTag->append($js);
    foreach ($this->rows as $row) {
      $scriptTag->append($this->createLog($row['type'], $row['message']));
    }
    echo $scriptTag;
    return $this;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function clear() {
    $this->rows = [];
    return $this;
  }

}
