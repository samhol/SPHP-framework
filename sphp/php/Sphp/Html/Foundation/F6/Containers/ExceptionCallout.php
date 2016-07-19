<?php

/**
 * ExceptionCallout.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Exception;
use Sphp\Html\Div as Div;
use Sphp\Html\Span as Span;
use Sphp\Html\Lists\Ol as Ol;
use Sphp\Html\Lists\Li as Li;
use Sphp\Html\Lists\Dl as Dl;

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
    $this->cssClasses()->lock("sphp-exception-callout");
    $this->buildHeading()
            ->showTrace($showTrace)
            ->showPreviousException($showPreviousException);
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
   * Builds the heading part of the viewer
   *
   * @return self for PHP Method Chaining
   */
  private function buildHeading() {
    $heading = (new Div())
            ->addCssClass("heading")
            ->append('<span class="exception">' . get_class($this->exception) . ":</span>");

    $message = (new Span("<small>" . $this->exception->getMessage() . "</small>"))
            ->addCssClass("message");
    $heading->append($message);
    $this->content()["heading"] = $heading;
    return $this;
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
              ->addCssClass("previous")
              ->append("Previous exception: <span class=\"exception\">" . get_class($prev) . "</span>")
              ->append(" on line <span class=\"number\">#{$prev->getLine()}</span>")
              ->append(" of file <div class=\"file\">'{$this->parsePath($prev->getFile())}'</div>");
      $this->content()["previous"] = $heading;
    } else {
      $this->content()["previous"] = null;
    }
    return $this;
  }

  /**
   * Builds the {@link \Exception} trace view
   *
   * @return self for PHP Method Chaining
   */
  private function buildTrace() {
    $traceArr = $this->exception->getTrace();
    if ($this->showTrace && count($traceArr) > 0) {
      $heading = (new Div())
              ->addCssClass("previous");
      $heading->append(' on line <span class="number">#' . $this->exception->getLine() . "</span>")
              ->append(' of file <div class="file">' . $this->parsePath($this->exception->getFile()) . "</div>");
      $this->content()["file+row"] = $heading;
      $this->content()["trace"] = (new Div($this->parseTrace($traceArr)))->addCssClass("trace");
    } else {
      $this->content()["file+row"] = null;
      $this->content()["trace"] = null;
    }
    //$this->getInnerContent()[] = "<pre>" . print_r($e->getTrace(), true) . "</pre>";
    return $this;
  }

  /**
   * Parses the given string by adding Word Break Opportunitiy tags to the string
   *
   * @param  string $path the path to parse
   * @return string parsed path
   */
  private function parsePath($path) {
    return str_replace(['/', '.'], ['/<wbr>', '.<wbr>'], $path);
  }

  /**
   * Builds the trace information of the {@link \Exception}
   *
   * @param  string[] $trace the trace of the viewed {@link \Exception}
   * @return Li the trace information
   */
  private function parseTrace(array $trace) {
    $vbr = function($v) {
      return str_replace('\\', '\\<wbr>', $v);
    };
    $ul = new Ol();
    $ul->addCssClass("trace");
    //$li1 = new Lists\Li();
    foreach ($trace as $traceRow) {
      $err1 = new Li();
      if (array_key_exists("line", $traceRow) && array_key_exists("file", $traceRow)) {
        $err1->set("line", "on line <span class=\"number\">#{$vbr($traceRow["line"])}</span>")
                ->set("file", " of file <wbr><span class=\"file\">{$this->parsePath($traceRow["file"])}</span>");
      }
      $err1->set("function", $this->parseFunction($traceRow));
      $ul[] = $err1;
    }
    return $ul;
  }

  /**
   * Builds the information about the method described in a trace row
   *
   * @param  string[] $trRow the trace row of the viewed {@link \Exception}
   * @return Dl|null the information about the method described in a trace row or null
   */
  private function parseFunction(array $trRow) {
    $methodStr = "";
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

}
