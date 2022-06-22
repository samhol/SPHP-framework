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

use Sphp\Config\ErrorHandling\ExceptionListener;
use Stringable;
use Throwable;
use Sphp\Html\Layout\Section;
use Sphp\Html\Layout\Div;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Tags;

/**
 * Implements Foundation Callout for Exception presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ThrowableSectionBuilder implements ExceptionListener {

  private ThrowableTraceBuilder $traceBuilder;
  private bool $showFile = false;
  private bool $showTrace = false;
  private bool $showPreviousThrowable = false;

  /**
   * Constructor
   *
   * @param ThrowableTraceBuilder|null $traceBuilder
   */
  public function __construct(?ThrowableTraceBuilder $traceBuilder = null) {
    if ($traceBuilder === null) {
      $traceBuilder = new ThrowableTraceBuilder();
    }
    $this->traceBuilder = $traceBuilder;
  }

  /**
   * Destructs the instance
   */
  public function __destruct() {
    unset($this->traceBuilder);
  }

  public function __invoke(Throwable $e): void {
    $this->onException($e);
  }

  /**
   * Sets the visibility of the file paths
   * 
   * @param  bool $show true for visible file
   * @return $this for a fluent interface
   */
  public function showInitialFile(bool $show) {
    $this->showFile = $show;
    return $this;
  }

  /**
   * Sets the trace visibility
   * 
   * @param  bool $show true for visible trace  
   * @return $this for a fluent interface
   */
  public function showTrace(bool $show) {
    $this->showTrace = $show;
    return $this;
  }

  /**
   * Sets the previous exception visibility
   * 
   * @param  bool $show true for visible previous exception
   * @return $this for a fluent interface
   */
  public function showPreviousException(bool $show) {
    $this->showPreviousThrowable = $show;
    return $this;
  }

  /**
   * Builds the file information of the exception
   *
   * @param  Throwable $e throwable object 
   * @return Stringable|string the basic information of the Throwable
   */
  private function buildBasicInformation(Throwable $e): Stringable|string {
    $aside = new Div();
    $aside->appendDiv(get_class($e))->addCssClass('h1');
    $aside->appendDiv($e->getMessage())->addCssClass('h2');
    $ul = new Ul();
    $ul->append(
            Tags::strong('code: ') .
            Tags::var($e->getCode())->addCssClass('number'));
    if ($this->showFile) {
      $ul->append(
              Tags::strong('file: ') .
              Tags::var($this->parsePath($e->getFile()))->addCssClass('message'));
      $ul->append(
              Tags::strong('line: ') .
              Tags::var($e->getLine())->addCssClass('number'));
    }
    $aside->append($ul);
    return $aside;
  }

  /**
   * Builds the file information of the exception
   *
   * @param  Throwable $e throwable object 
   * @return Stringable|string the basic information of the Throwable
   */
  private function buildPrevious(Throwable $e): Stringable|string {
    $out = new Div();
    $out->addCssClass('previous-exception');
    $out->appendDiv(get_class($e))->addCssClass('h3');
    $out->appendDiv($e->getMessage())->addCssClass('h4');
    $ul = new Ul();
    $ul->append(
            Tags::strong('code: ') .
            Tags::var($e->getCode())->addCssClass('number'));
    if ($this->showFile) {
      $ul->append(
              Tags::strong('file: ') .
              Tags::var($this->parsePath($e->getFile()))->addCssClass('message'));
      $ul->append(
              Tags::strong('line: ') .
              Tags::var($e->getLine())->addCssClass('number'));
    }
    $out->append($ul);
    return $out;
  }

  /**
   * Builds the previous exception view
   *
   * @param  Throwable $e throwable object 
   * @return Stringable|string the file information of the previous exception
   */
  private function buildPreviousException(Throwable $e): Stringable|string|null {
    $prev = $e->getPrevious();
    if ($prev !== null) {
      $out = new Div();
      $out->addCssClass('previous-exeptions');
      $out->appendDiv('Previous Exceptions')->addCssClass('h2');
      while ($prev !== null) {
        //echo $prev->getMessage();
        $out->append($this->buildPrevious($prev));
        $prev = $prev->getPrevious();
      }
    } else {
      $out = null;
    }
    return $out;
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
   * Creates the callout object
   * 
   * @param  Throwable $e object thrown
   * @return Stringable|string the object created
   */
  public function build(Throwable $e): Stringable|string {
    $output = new Section();
    $output->cssClasses()->protectValue('sphp-throwable-section');
    $output->append($this->buildBasicInformation($e));
    if ($this->showTrace) {
      $output->append($this->traceBuilder->buildTrace($e));
    }
    if ($this->showPreviousThrowable) {
      $output->append($this->buildPreviousException($e));
    }
    return $output;
  }

  public function onException(Throwable $e): void {
    $this->build($e)->printHtml();
  }

}
