<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling\Views;

use Throwable;
use Sphp\Html\Layout\Div;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Tags;
use Stringable;
/**
 * Class ThrowableTraceBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ThrowableTraceBuilder {

  /**
   * Builds the trace information of the throwable object 
   *
   * @param  Throwable $e throwable object
   * @return Stringable|string the trace information 
   */
  public function buildTrace(Throwable $e): Stringable|string {
    $cont = new Div();
    $cont->addCssClass('trace');
    $trace = $e->getTrace();
    $cont->appendDiv('Trace information:')->addCssClass('h2');
    if (count($trace) > 0) {
      $list = new Ol();
      foreach ($trace as $traceRow) {
        $list->append($this->parseLine($traceRow));
      }
      $cont->append($list);
    }
    return $cont;
  }

  /**
   * 
   * @param  array $data
   * @return Stringable|string
   */
  private function parseLine(array $data): Stringable|string {
    $ul = new Ul();
    $ul->addCssClass('trace-line');
    if (array_key_exists('file', $data)) {
      $ul->append(Tags::strong('file: ') . Tags::var($this->parsePath($data['file'])));
    }
    if (array_key_exists('line', $data)) {
      $ul->append(Tags::strong('line: ') . Tags::var($data['line']));
    }
    if (array_key_exists('class', $data)) {
      $ul->append(Tags::strong('class: ') . Tags::var($this->parsePath($data['class'])));
    }
    if (array_key_exists('class', $data) && array_key_exists('function', $data) && array_key_exists('type', $data)) {
      if ($data['type'] === '::') {
        $type = 'static method: ';
      } else if ($data['type'] === '->') {
        $type = 'instance method: ';
      } else {
        $type = 'method: ';
      }
      $ul->append(Tags::strong($type) . Tags::var($this->parsePath($data['function'])));
    } else if (array_key_exists('function', $data)) {
      $ul->append(Tags::strong('function: ') . Tags::var($this->parsePath($data['function'])));
    } if (array_key_exists('args', $data)) {
      $ul->append(Tags::strong('arguments: ') . $this->parseArguments($data['args']));
    }
    return $ul;
  }

  /**
   * 
   * @param  array $params
   * @return Stringable|string
   */
  private function parseArguments(array $params): Stringable|string {
    $list = new Ol();
    $list->addCssClass('arguments');
    foreach ($params as $arg) {
      if (is_string($arg)) {
        $string = $this->parsePath($arg);
        $list->append("'$string'");
      } else if (is_bool($arg)) {
        $list->append(($arg) ? 'true' : 'false');
      } else if (is_null($arg)) {
        $list->append('null');
      } else if (is_array($arg)) {
        $list->append('array');
      } else if (is_resource($arg)) {
        $type = get_resource_type($arg);
        $list->append("$type resource");
      } else if (gettype($arg) === 'object') {
        $list->append('object(' . get_class($arg) . ')');
      } else {
        $list->append($arg);
      }
    }
    return $list;
  }

  /**
   * Parses the given string by adding Word Break opportunity tags to the string
   *
   * @param  string $path the path to parse
   * @return string parsed path
   */
  private function parsePath(string $path): string {
    return str_replace(['\\', '/', '.'], ['\\<wbr>', '/<wbr>', '.<wbr>'], $path);
  }

}
