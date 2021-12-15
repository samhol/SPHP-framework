<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use Sphp\Html\AbstractContent;
use Sphp\Html\Scripts\InlineScript;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Implements PHP message outputting To Browser Console
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Console extends AbstractContent {

  /**
   * @var string[] 
   */
  private static $types = [
      'time', 'timeLog', 'timeEnd',
      'log',
      'info',
      'warn',
      'error',
      'table',
      'group', 'groupCollapsed', 'groupEnd',
      'trace',];

  /**
   * @var string[] 
   */
  private ?string $js = null;
  private int $groupLevel = 0;

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments
   * @throws BadMethodCallException
   * @throws InvalidArgumentException
   */
  public function __call(string $name, array $arguments) {
    if (!in_array($name, static::$types)) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $message = $this->parseMessage(array_shift($arguments));
    $this->js .= "console.$name($message);";
    return $this;
  }

  private function parseMessage($message): string {
    if (is_iterable($message) | is_object($message)) {
      $message = ParseFactory::json()->toString($message, JSON_UNESCAPED_SLASHES);
      //echo "console.$type($data);";
    } else if (is_string($message)) {
      $message = "'$message'";
    } else if (is_bool($message)) {
      $message = $message ? 'true' : 'false';
    } else if (is_numeric($message) || is_null($message)) {
      $message = (string) $message;
    } else {
      throw new InvalidArgumentException();
    }
    return $message;
  }

  public function log($message) {
    $this->js .= "console.log({$this->parseMessage($message)});";
    return $this;
  }

  public function warn($message) {
    $this->js .= "console.warn({$this->parseMessage($message)});";
    return $this;
  }

  public function error($message) {
    $this->js .= "console.error({$this->parseMessage($message)});";
    return $this;
  }

  public function info($message) {
    $this->js .= "console.info({$this->parseMessage($message)});";
    return $this;
  }

  public function time(string $label) {
    $this->js .= "console.time('$label');";
    return $this;
  }

  public function timeLog(string $label) {
    $this->js .= "console.timeLog('$label');";
    return $this;
  }

  public function timeEnd(string $label) {
    $this->js .= "console.timeEnd('$label');";
    return $this;
  }

  public function startGroup() {
    $this->js .= 'console.group();';
    $this->groupLevel += 1;
    return $this;
  }

  public function groupCollapsed(?string $label = null) {
    if ($label === null) {
      $this->js .= 'console.groupCollapsed();';
    } else {
      $this->js .= "console.groupCollapsed('$label');";
    }
    $this->groupLevel += 1;
    return $this;
  }

  public function endGroup() {
    if ($this->groupLevel > 0) {
      $this->js .= 'console.groupEnd();';
      $this->groupLevel -= 1;
    }
    return $this;
  }

  public function clear() {
    $this->js .= 'console.clear();';
    return $this;
  }

  /**
   * 
   * @param  iterable|object $data
   * @param  array $columns
   * @return $this
   */
  public function table($data, array $columns = null) {
    $params[] = ParseFactory::json()->toString($data, JSON_UNESCAPED_SLASHES);
    if (empty($columns)) {
      $str = 'console.table(%s);';
    } else {
      $params[] = ParseFactory::json()->toString($columns, JSON_UNESCAPED_SLASHES);
      $str = 'console.table(%s,%s);';
    }
    $this->js .= sprintf($str, ...$params);
    return $this;
  }

  public function generateScript(bool $closeGroups = true): ?string {
    if ($this->isEmpty()) {
      return null;
    }
    $out = $this->js;
    if ($closeGroups) {
      $level = $this->groupLevel;
      while ($level > 0) {
        $out .= 'console.groupEnd();';
        $level--;
      }
    }
    return $out;
  }

  public function createScriptTag(bool $closeGroups = true): ?InlineScript {
    if ($this->isEmpty()) {
      return null;
    }
    return new InlineScript($this->generateScript($closeGroups));
  }

  public function run(): void {
    echo $this->getHtml();
  }

  public function isEmpty(): bool {
    return $this->js === null;
  }

  /**
   * Clears the log
   * 
   * @return $this for a fluent interface
   */
  public function emptyMedhods() {
    $this->js = null;
    $this->groupLevel = 0;
    return $this;
  }

  public function getHtml(): string {
    if (!$this->isEmpty()) {
      return (string) $this->createScriptTag();
    }
    return '';
  }

}
