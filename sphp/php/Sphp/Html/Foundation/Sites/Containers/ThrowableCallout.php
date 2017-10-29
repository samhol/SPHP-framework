<?php

/**
 * ExceptionCallout.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Throwable;
use Sphp\Html\Div;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Lists\Li;
use Sphp\Html\Lists\Dl;

/**
 * Implements Foundation Callout for {@link \Exception} presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ThrowableCallout extends Callout {

  /**
   * @var boolean
   */
  private $showMessage = true;

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
   * the viewed exception
   *
   * @var Throwable 
   */
  private $throwable;

  /**
   * Constructs a new instance
   *
   * @param  Throwable $e the viewed throwable
   * @param  boolean $showTrace true for visible trace  
   * @param  boolean $showPreviousException true for visible previous exception
   */
  public function __construct(Throwable $e, bool $showTrace = false, bool $showPreviousException = false) {
    $this->throwable = $e;
    parent::__construct();
    $this->cssClasses()->protect('sphp-exception-callout');
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
   * @return string the file information of the exception
   */
  private function buildFile(): string {
    $output = '<p class="message">on line <span class="number">#' . $this->throwable->getLine() . '</span>';
    $output .= ' of file <span class="file">' . $this->parsePath($this->throwable->getFile()) . '</span></p>';
    return $output;
  }

  /**
   * Builds the previous {@link \Throwable} view
   *
   * @return $this for a fluent interface
   */
  private function buildPreviousException() {
    $prev = $this->throwable->getPrevious();
    if ($this->showPreviousThrowable && $prev instanceof \Exception) {
      $heading = (new Div())
              ->addCssClass('previous')
              ->append('Previous exception: <span class="exception">' . get_class($prev) . '</span>')
              ->append(" on line <span class=\"number\">#{$prev->getLine()}</span>")
              ->append(" of file <div class=\"file\">'{$this->parsePath($prev->getFile())}'</div>");
      $this->getInnerContainer()['previous'] = $heading;
    } else {
      $this->getInnerContainer()['previous'] = null;
    }
    return $this;
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

  /**
   * Builds the trace information of the {@link \Exception}
   *
   * @return string the trace information or an empty string
   */
  private function buildTrace(): string {
    $trace = $this->throwable->getTrace();
    if (count($trace) > 0) {
      $output = new Ol();
      $output->addCssClass('trace');
      //$li1 = new Lists\Li();
      foreach ($trace as $traceRow) {
        $err1 = new Li();
        if (array_key_exists('line', $traceRow) && array_key_exists("file", $traceRow)) {
          $err1->append("on line <span class=\"number\">#{$this->parsePath($traceRow["line"])}</span>")
                  ->append(" of file <wbr><span class=\"file\">'{$this->parsePath($traceRow["file"])}'</span>");
        }
        $err1->append("" . $this->parseFunction($traceRow));
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
  private function parseFunction(array $trRow): string {
    echo "<pre>";
    echo $this->throwable->getTraceAsString();
    echo "</pre>";
    $methodStr = "while executing ";
    if (array_key_exists("class", $trRow)) {
      $methodStr .= $this->parsePath($trRow["class"]);
    }
    if (array_key_exists("type", $trRow)) {
      $methodStr .= $trRow["type"];
    }
    if (array_key_exists("function", $trRow)) {
      $dl = new Dl();
      $dl->appendTerms($methodStr . "{$trRow["function"]}():");
      if (array_key_exists("args", $trRow)) {
        $dl->appendDescriptions($trRow["args"]);
      }
      return "$dl";
    } else {
      return '';
    }
  }

  public function contentToString(): string {
    $output = '<h2>' . get_class($this->throwable) . '</h2>';
    if ($this->showMessage) {
      $output .= '<p class="message">' . $this->throwable->getMessage() . '</p>';
    }
    if ($this->showFile) {
      $output .= $this->buildFile();
    }
    if ($this->showTrace) {
      $output .= $this->buildTrace();
    }
    return $output;
  }

}
