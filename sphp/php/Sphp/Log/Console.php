<?php

/**
 * Console.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Log;

use Sphp\Html\Programming\ScriptCode;

/**
 * Description of Console
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-03-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Console {

  const LOG = 'log';
  const INFO = 'info';
  const WARN = 'warn';
  const ERROR = 'error';

  private static $types = [self::LOG, self::INFO, self::WARN, self::ERROR];
  private $rows = [];

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments) {
    if (!isset(static::$types[$name])) {
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

  /**
   * Logs messages/variables/data to browser console from within php
   *
   * @param $name message to be shown for optional data/vars
   * @param $data variable (scalar/mixed) arrays/objects, etc to be logged
   * @param $jsEval whether to apply JS eval() to arrays/objects
   *
   * @return none
   * @author Sarfraz
   */
  public static function log($name, $data = NULL, $jsEval = FALSE) {
    
  }

  protected function createLog(string $type, string $data) {

    $data = $data ? $data : '';
    $search_array = array("#'#", '#""#', "#''#", "#\n#", "#\r\n#");
    $replace_array = array('"', '', '', '\\n', '\\n');
    $data = preg_replace($search_array, $replace_array, $data);
    $data = ltrim(rtrim($data, '"'), '"');

    return "console.$type('$data');";
  }

  public function add(string $type, string $logText) {
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

  public function clear() {
    $this->rows = [];
    return $this;
  }

}
