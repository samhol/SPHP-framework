<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Throwable;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Config\ErrorHandling\ExceptionListener;

/**
 * Implements Foundation Callout for {@link \Exception} presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ThrowableCalloutBuilder implements ExceptionListener {

  /**
   * @var boolean
   */
  private $showFile = false;

  /**
   * @var boolean
   */
  private $showTrace = false;

  /**
   * @var boolean
   */
  private $showPreviousThrowable = false;

  /**
   * Constructor
   *
   * @param  boolean $showTrace true for visible trace  
   * @param  boolean $showPreviousException true for visible previous exception
   */
  public function __construct(bool $showTrace = false, bool $showPreviousException = false) {
    $this->showTrace($showTrace)
            ->showPreviousException($showPreviousException);
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  boolean $show true for visible file
   * @return $this for a fluent interface
   */
  public function showInitialFile(bool $show = true) {
    $this->showFile = $show;
    return $this;
  }

  /**
   * Sets the trace visibility
   * 
   * @param  boolean $show true for visible trace  
   * @return $this for a fluent interface
   */
  public function showTrace(bool $show = true) {
    $this->showTrace = $show;
    //$this->buildTrace();
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  boolean $show true for visible previous exception
   * @return $this for a fluent interface
   */
  public function showPreviousException(bool $show = true) {
    $this->showPreviousThrowable = $show;
    //$this->buildPreviousException();
    return $this;
  }

  /**
   * Builds the file information of the exception
   *
   * @param  Throwable $e throwable object 
   * @return string the file information of the exception
   */
  private function buildExceptionMessage(Throwable $e): string {
    $heading = '<h2>' . get_class($e) . '</h2>';
    $ul = new \Sphp\Html\Lists\Ul();
    $ul->append('<span class="note">Message: </span><span class="message">' . $this->parsePath($e->getMessage()) . '</span>')->addCssClass('message');
    if ($this->showFile) {
      $ul->append('<span class="note">File:</span> <span class="file">' . $this->parsePath($e->getFile()) . '</span>');
      $ul->append('<span class="note">Line:</span> <span class="number">#' . $e->getLine() . '</span>');
    }
    return $heading . $ul;
  }

  /**
   * Builds the previous exception view
   *
   * @param  Throwable $e throwable object 
   * @return string the file information of the previous exception
   */
  private function buildPreviousException(Throwable $e): string {
    $prev = $e->getPrevious();
    $output = "";
    if ($prev instanceof \Throwable) {
      $output .= '<div class="previous-exeption"><h2 class="previous">Previous:</h2>';
      $output .= $this->buildCalloutContent($prev) . '</div>';
    }
    return $output;
  }

  /**
   * Parses the given string by adding Word Break opportunity tags to the string
   *
   * @param  string $path the path to parse
   * @return string parsed path
   */
  protected function parsePath(string $path): string {
    return str_replace(['\\', '/', '.'], ['\\<wbr>', '/<wbr>', '.<wbr>'], $path);
  }

  /**
   * Builds the trace information of the throwable object 
   *
   * @param  Throwable $e throwable object 
   * @return string the trace information or an empty string
   */
  protected function buildTrace(Throwable $e): string {
    $trace = $e->getTrace();
    if (count($trace) > 0) {
      $output = new Ol();
      $output->addCssClass('trace');
      foreach ($trace as $traceRow) {
        $err1 = '';
        if (array_key_exists('line', $traceRow) && array_key_exists('file', $traceRow)) {
          $err1 .= "<span class=\"note\">File:</span> <span class=\"path\">'{$this->parsePath($traceRow['file'])}'</span>";
          $err1 .= "<br><span class=\"note\">Line:</span> <span class=\"line-number\">#{$traceRow['line']}</span>";
        } else {
          $err1 .= "[internal]:";
        }
        $err1 .= $this->parseFunction($traceRow);
        $output->append($err1);
      }
      return '<h3 class"trace">Trace information:</h3>' . $output;
    } else {
      return '';
    }
  }

  /**
   * Builds the information about the method described in a trace row
   *
   * @param  string[] $trRow the trace row of the viewed {@link \Exception}
   * @return string the information about the method described in a trace row or null
   */
  protected function parseFunction(array $trRow): string {
    $methodStr = '';
    if (array_key_exists('class', $trRow)) {
      $methodStr .= $this->parsePath($trRow['class']);
    }
    if (array_key_exists('type', $trRow)) {
      $methodStr .= $this->parsePath($trRow['type']);
    }
    if (array_key_exists('function', $trRow)) {
      $methodStr .= $this->parsePath($trRow['function']);
    }
    if (array_key_exists('args', $trRow) && is_array($trRow['args'])) {
      $methodStr .= $this->parseParams($trRow['args']);
    } else {
      $methodStr .= '()';
    }
    if (!empty($methodStr)) {
      $methodStr = "<br><span class=\"note\">Call:</span> <span class=\"method\">$methodStr</span>";
    }
    return $methodStr;
  }

  /**
   * 
   * @param  array $params
   * @return string
   */
  protected function parseParams(array $params): string {
    $p = [];
    foreach ($params as $num => $arg) {
      if (is_string($arg)) {
        $string = $this->parsePath($arg);
        $p[$num] = "'$string'";
      } else if (is_bool($arg)) {
        $p[$num] = ($arg) ? 'true' : 'false';
      } else if (is_numeric($arg)) {
        $p[$num] = $arg;
      } else if (is_null($arg)) {
        $p[$num] = 'null';
      } else if (is_array($arg)) {
        $p[$num] = 'array' . $this->parseParams($arg);
      } else if (gettype($arg) === 'object') {
        $p[$num] = 'object(' . get_class($arg) . ')';
      } else {
        $p[$num] = $arg;
      }
    }
    return '(' . implode(', ', $p) . ')';
  }

  /**
   * Creates the content of the callout
   * 
   * @param  Throwable $e throwable object 
   * @return string
   */
  protected function buildCalloutContent(Throwable $e): string {
    $output = $this->buildExceptionMessage($e);
    if ($this->showTrace) {
      $output .= $this->buildTrace($e);
    }
    if ($this->showPreviousThrowable) {
      $output .= $this->buildPreviousException($e);
    }
    return $output;
  }

  /**
   * Creates the callout object
   * 
   * @param  Throwable $e object thrown
   * @return ContentCallout the object created
   */
  public function buildCallout(Throwable $e): ContentCallout {
    $callout = new ContentCallout();
    $callout->cssClasses()->protectValue('sphp-exception-callout');
    $callout->append($this->buildCalloutContent($e));
    return $callout;
  }

  public function onException(Throwable $e): void {
    $this->buildCallout($e)->printHtml();
  }

  /**
   * Generates a callout for given throwable
   * 
   * @param  Throwable $e object thrown
   * @param  bool $showTrace
   * @param  bool $showPreviousException
   * @return ContentCallout
   */
  public static function build(Throwable $e, bool $showTrace = false, bool $showPreviousException = false): ContentCallout {
    $instance = new static($showTrace, $showPreviousException);
    return $instance->buildCallout($e);
  }

}
