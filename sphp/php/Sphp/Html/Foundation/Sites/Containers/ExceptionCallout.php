<?php

/**
 * ExceptionCallout.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Exception;
use Sphp\Html\Div;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Lists\Li;
use Sphp\Html\Lists\Dl;

/**
 * Class implements a simple HTML structure for {@link \Exception} presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExceptionCallout extends Callout {

  /**
   *
   * @var boolean
   */
  private $showMessage = true;

  /**
   *
   * @var boolean
   */
  private $showFile = false;

  /**
   *
   * @var boolean
   */
  private $showTrace = false;

  /**
   *
   * @var boolean
   */
  private $showPreviousException = false;

  /**
   * the viewed exception
   *
   * @var Exception 
   */
  private $exception;

  /**
   * Constructs a new instance
   *
   * @param  Exception $e the viewed exception
   * @param  boolean $showTrace true for visible trace  
   * @param  boolean $showPreviousException true for visible previous exception
   */
  public function __construct(Exception $e, $showTrace = false, $showPreviousException = false) {
    $this->exception = $e;
    parent::__construct();
    $this->cssClasses()->lock('sphp-exception-callout');
    $this->showTrace($showTrace)
            ->showPreviousException($showPreviousException);
  }

  /**
   * Sets the visibility of the file
   * 
   * @param  boolean $show true for visible file
   * @return self for PHP Method Chaining
   */
  public function showInitialFile($show = true) {
    $this->showFile = $show;
    return $this;
  }

  /**
   * Sets the trace visibility
   * 
   * @param  boolean $show true for visible trace  
   * @return self for PHP Method Chaining
   */
  public function showTrace($show = true) {
    $this->showTrace = $show;
    $this->buildTrace();
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  boolean $show true for visible previous exception
   * @return self for PHP Method Chaining
   */
  public function showPreviousException($show = true) {
    $this->showPreviousException = $show;
    $this->buildPreviousException();
    return $this;
  }

  /**
   * Builds the file information of the exception
   *
   * @return string the file information of the exception
   */
  private function buildFile() {
    $output = '<p class="message">on line <span class="number">#' . $this->exception->getLine() . '</span>';
    $output .= ' of file <span class="file">' . $this->parsePath($this->exception->getFile()) . '</span></p>';
    return $output;
  }

  /**
   * Builds the previous {@link \Exception} view
   *
   * @return self for PHP Method Chaining
   */
  private function buildPreviousException() {
    $prev = $this->exception->getPrevious();
    if ($this->showPreviousException && $prev instanceof \Exception) {
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
   * Parses the given string by adding Word Break Opportunitiy tags to the string
   *
   * @param  string $path the path to parse
   * @return string parsed path
   */
  private function parsePath($path) {
    return str_replace(['\\', '/', '.'], ['\\<wbr>', '/<wbr>', '.<wbr>'], $path);
  }

  /**
   * Builds the trace information of the {@link \Exception}
   *
   * @return string|Li the trace information or an empty string
   */
  private function buildTrace() {
    $vbr = function($v) {
      return str_replace(['\\', '/', '.'], ['\\<wbr>', '/<wbr>', '.<wbr>'], $v);
    };
    $trace = $this->exception->getTrace();
    if (count($trace) > 0) {
      $output = new Ol();
      $output->addCssClass("trace");
      //$li1 = new Lists\Li();
      foreach ($trace as $traceRow) {
        $err1 = new Li();
        if (array_key_exists("line", $traceRow) && array_key_exists("file", $traceRow)) {
          $err1->offsetSet("line", "on line <span class=\"number\">#{$this->parsePath($traceRow["line"])}</span>")
                  ->offsetSet("file", " of file <wbr><span class=\"file\">'{$this->parsePath($traceRow["file"])}'</span>");
        }
        $err1->offsetSet("function", "" . $this->parseFunction($traceRow));
        $output[] = $err1;
      }
      return '<h3 class"trace">Trace information:</h3>' . $output;
    } else {
      return "";
    }
  }

  /**
   * Builds the information about the method described in a trace row
   *
   * @param  string[] $trRow the trace row of the viewed {@link \Exception}
   * @return Dl|null the information about the method described in a trace row or null
   */
  private function parseFunction(array $trRow) {
    //echo "<pre>";
    //print_r($trRow);
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
      return $dl;
    } else {
      return null;
    }
  }

  public function contentToString() {
    $output = "<h2>" . get_class($this->exception) . "</h2>";
    if ($this->showMessage) {
      $output .= '<p class="message">' . $this->exception->getMessage() . "</p>";
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
