<?php

/**
 * CodeExampleBuider.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;

/**
 * Implements an accordion for PHP Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation 6 Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CodeExampleBuider implements \Sphp\Html\ContentInterface {

 use \Sphp\Html\ContentTrait;
  const HTMLFLOW = 'html';
  const OUTPUT_TEXT = 'text';
  const EXAMPLECODE = 'code';

  private $titles = [];

  /**
   *
   * @var string 
   */
  private $path;

  /**
   *
   * @var boolean
   */
  private $showHtmlFlow = true;

  /**
   *
   * @var boolean|string
   */
  private $outputHl = false;

  /**
   * Constructs a new instance
   *
   * @param string $path the file path of the presented example PHP code
   * @param string|boolean $highlightOutput the language name of the output code 
   *        or false if highlighted output code should not be visible
   * @param boolean $outputAsHtmlFlow true for executed html result or false for no execution
   */
  public function __construct($path = null, $highlightOutput = false, $outputAsHtmlFlow = true) {
    $this->useDefaultTitles();
    $this->setPath($path);
    $this->setOutpputHighlighting($highlightOutput);
    $this->setHtmlFlowVisibility($outputAsHtmlFlow);
  }

  public function __destruct() {
    // unset($this->codePane, $this->outputSyntaxPane, $this->outputPane);
  }

  /**
   * 
   * @param  string $path the file path of the presented example PHP code
   * @param  boolean $highlightOutput true for highlighted program code as the 
   *         output presentation, false for html presentation
   * @param  string $outputLang the language name of the output code
   * @return Accordion
   */
  public function __invoke($path, $highlightOutput = false, $outputLang = true) {
    if ($path !== null) {
       $this->setPath($path);
    }
    $this->setPath($path)
            ->setOutpputHighlighting($highlightOutput)
            ->setHtmlFlowVisibility($outputLang);
    return $this->buildAccordion();
  }

  /**
   * 
   * @return string
   */
  public function getPath() {
    return $this->path;
  }

  /**
   * 
   * @param  string $path the path of the example code
   * @return self for a fluent interface
   */
  public function setPath($path) {
    $this->path = $path;
    return $this;
  }

  /**
   * 
   * @return boolean
   */
  public function showHtmlFlow() {
    return $this->showHtmlFlow;
  }

  public function getHighlightOutput() {
    return $this->outputHl;
  }

  /**
   * 
   * @param  boolean $highlightOutput
   * @return self for a fluent interface
   */
  public function setOutpputHighlighting($highlightOutput) {
    $this->outputHl = $highlightOutput;
    return $this;
  }

  /**
   * 
   * @param  boolean $showHtmlFlow
   * @return self for a fluent interface
   */
  public function setHtmlFlowVisibility($showHtmlFlow) {
    $this->showHtmlFlow = (boolean) $showHtmlFlow;
    return $this;
  }

  /**
   * 
   * @return Accordion
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function buildAccordion() {
    if (!is_file($this->path)) {
      throw new \Sphp\Exceptions\RuntimeException();
    }
    $accordion = new Accordion();
    $accordion->allowAllClosed()
            ->allowMultiExpand();
    $accordion->cssClasses()->lock('manual');
    $accordion->append($this->getCodePane());
    if ($this->getHighlightOutput()) {
      $accordion->append($this->buildHighlightedOutput());
    }
    if ($this->showHtmlFlow()) {
      $accordion->append($this->buildHtmlFlow());
    }
    return $accordion;
  }

  /**
   * Loads the example PHP file content
   *
   * @param  string $path the file path of the example PHP code
   * @param string|boolean $highlightOutput the language name of the output code 
   *        or false if highlighted output code should not be visible
   * @param boolean $outputAsHtmlFlow true for executed html result or false for no execution
   * @return Accordion
   */
  public function fromFile($path, $highlightOutput = false, $outputAsHtmlFlow = true) {
    $this->setPath($path)
            ->setOutpputHighlighting($highlightOutput)
            ->setHtmlFlowVisibility($outputAsHtmlFlow);
    return $this->buildAccordion();
  }

  /**
   * 
   * @return SyntaxHighlightingPane
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function buildHighlightedOutput() {
    if (!is_file($this->path)) {
      throw new \Sphp\Exceptions\RuntimeException();
    }
    $outputSyntaxPane = new SyntaxHighlightingPane();
    if ($this->outputHl === 'text') {
      $outputSyntaxPane->useDefaultContentCopyController(false);
    } else {
      $outputSyntaxPane->useDefaultContentCopyController(true);
    }
    $outputSyntaxPane->setPaneTitle($this->titles[self::OUTPUT_TEXT]);
    $outputSyntaxPane->executeFromFile($this->path, $this->outputHl);
    return $outputSyntaxPane;
  }

  /**
   * 
   * @return Pane
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function buildHtmlFlow() {
    if (!is_file($this->path)) {
      throw new \Sphp\Exceptions\RuntimeException();
    }
    $outputPane = (new Pane())->addCssClass('html-output');
    $outputPane->setPaneTitle($this->titles[self::HTMLFLOW]);
    $outputPane->appendPhpFile($this->path);
    return $outputPane;
  }

  /**
   * Returns the code panel
   *
   * @return SyntaxHighlightingPane
   */
  public function getCodePane($path = null) {
    if ($path === null) {
      $path = $this->path;
    }
    $codePane = (new SyntaxHighlightingPane());
    $codePane->setPaneTitle($this->titles[self::EXAMPLECODE]);
    $codePane->loadFromFile($path);
    return $codePane;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return self for a fluent interface
   */
  public function useDefaultTitles() {
    $this->titles[self::EXAMPLECODE] = 'PHP code';
    $this->titles[self::OUTPUT_TEXT] = 'Execution result as highlighted code';
    $this->titles[self::HTMLFLOW] = 'Execution result as HTML5';
    return $this;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return self for a fluent interface
   */
  public function setExampleHeading($heading) {
    $this->titles[self::EXAMPLECODE] = $heading;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return self for a fluent interface
   */
  public function setOutputSyntaxPaneTitle($title) {
    $this->titles[self::OUTPUT_TEXT] = $title;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return self for a fluent interface
   */
  public function setOutputPaneTitle($title) {
    $this->titles[self::HTMLFLOW] = $title;
    return $this;
  }

  /**
   * Prints the PHP Example code and the preferred result
   *
   * @param  string $path the file path of the presented example PHP code
   * @param  boolean $highlightOutput true for highlighted program code
   *         presentation, false for html presentation
   * @param string $outputLang the language name of the highlighted output code
   */
  public static function visualize($path, $highlightOutput = false, $outputLang = 'html5') {
    (new static($path, $highlightOutput, $outputLang))->buildAccordion()->printHtml();
  }

  public function getHtml() {
    return $this->buildAccordion()->getHtml();
  }

}
