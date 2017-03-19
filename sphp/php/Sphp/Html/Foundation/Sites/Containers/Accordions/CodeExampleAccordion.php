<?php

/**
 * CodeExampleAccordion.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\ContentTrait;
use Sphp\Html\Adapters\VisibilityAdapter;

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
class CodeExampleAccordion extends Accordion {

  use ContentTrait;

  /**
   *
   * @var string 
   */
  private $path;

  /**
   * the php code example presentation
   *
   * @var SyntaxHighlightingPane
   */
  private $codePane;

  /**
   * the output as a html element
   *
   * @var Pane
   */
  private $outputPane;

  /**
   * the output as highlighted syntax
   *
   * @var SyntaxHighlightingPane
   */
  private $outputSyntaxPane;

  /**
   * Constructs a new instance
   *
   * @param string $path the file path of the presented example PHP code
   * @param string|boolean $highlightOutput the language name of the output code 
   *        or false if highlighted output code should not be visible
   * @param boolean $outputAsHtmlFlow true for executed html result or false for no execution
   */
  public function __construct($path = null, $highlightOutput = false, $outputAsHtmlFlow = true) {
    parent::__construct();
    $this->cssClasses()->lock('manual');
    $this->codePane = (new SyntaxHighlightingPane());
    $this->outputSyntaxPane = new SyntaxHighlightingPane();
    $this->outputPane = (new Pane())->addCssClass('html-output');
    $this->useDefaultTitles()
            ->append($this->codePane)
            ->append($this->outputSyntaxPane)
            ->append($this->outputPane)
            ->allowAllClosed()
            ->allowMultiExpand();
    if ($path !== null) {
      $this->fromFile($path, $highlightOutput, $outputAsHtmlFlow);
    } else {
      $this->showOutputSyntax($highlightOutput);
    }
  }

  public function __destruct() {
    unset($this->codePane, $this->outputSyntaxPane, $this->outputPane);
    parent::__destruct();
  }

  /**
   * 
   * @param  string $path the file path of the presented example PHP code
   * @param  boolean $highlightOutput true for highlighted program code as the 
   *         output presentation, false for html presentation
   * @param  string $outputLang the language name of the output code
   * @return self a new instance presenting the example 
   */
  public function __invoke($path, $highlightOutput = false, $outputLang = true) {
    $instance = new Static();
    $instance->fromFile($path, $highlightOutput, $outputLang);
    $instance->printHtml();
  }

  /**
   * Loads the example PHP file content
   *
   * @param  string $path the file path of the example PHP code
   * @param string|boolean $highlightOutput the language name of the output code 
   *        or false if highlighted output code should not be visible
   * @param boolean $outputAsHtmlFlow true for executed html result or false for no execution
   * @return self for a fluent interface
   */
  public function fromFile($path, $highlightOutput = false, $outputAsHtmlFlow = true) {
    $this->path = $path;
    $this->codePane->loadFromFile($path);
    //$this->outputPane->appendPhpFile($path);
    $this->showOutputAsHtmlFlow($outputAsHtmlFlow);
    // $executedOutput = FileUtils::executePhpToString($path);
    $this->showHighlightedOutput($highlightOutput);
    // $this->showOutputSyntax($highlightOutput);
    return $this;
  }

  /**
   * 
   * @param  mixed $lang
   * @return self for a fluent interface
   */
  public function showHighlightedOutput($lang) {
    $outputVisibility = new VisibilityAdapter($this->outputSyntaxPane);
    if ($lang === false) {
      $lang = "text";
      $outputVisibility->hide();
    } else {
      $outputVisibility->unhide();
    }
    if ($lang == "text") {
      $this->outputSyntaxPane->useDefaultContentCopyController(false);
    } else {
      $this->outputSyntaxPane->useDefaultContentCopyController(true);
    }
    $this->outputSyntaxPane->executeFromFile($this->path, $lang);
    return $this;
  }

  /**
   * 
   * @param  boolean $show true for executed HTML result or false for no execution
   * @return self for a fluent interface
   */
  public function showOutputAsHtmlFlow($show = true) {
    $outputPaneVisibility = new VisibilityAdapter($this->outputPane);
    if ($show === false) {
      $this->outputPane->clear();
      $outputPaneVisibility->hide();
    } else {
      $outputPaneVisibility->unhide();
      if ($this->path === null) {
        $this->outputPane->replaceContent('<code>HTML</code> output is not available!');
      }
      $this->outputPane->clear()->appendPhpFile($this->path);
    }
    return $this;
  }

  /**
   * Returns the code panel
   *
   * @return SyntaxHighlightingPane
   */
  public function getCodePane() {
    return $this->codePane;
  }

  /**
   * Returns the output execution panel
   *
   * @return Pane
   */
  public function getOutputPane() {
    return $this->outputPane;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return self for a fluent interface
   */
  public function useDefaultTitles() {
    $this->setExampleHeading('PHP code')
            ->setOutputSyntaxPaneTitle('Execution result as highlighted code')
            ->setOutputPaneTitle('Execution result as HTML5');
    return $this;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return self for a fluent interface
   */
  public function setExampleHeading($heading) {
    $this->codePane->setPaneTitle($heading);
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return self for a fluent interface
   */
  public function setOutputSyntaxPaneTitle($title) {
    $this->outputSyntaxPane->setPaneTitle($title);
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return self for a fluent interface
   */
  public function setOutputPaneTitle($title) {
    $this->outputPane->setPaneTitle($title);
    return $this;
  }

  /**
   * Sets the output presentation as a highlighted program code or
   * as an html component
   *
   * @param  boolean $show true for highlighted program code
   *         presentation, false for html presentation
   * @return self for a fluent interface
   */
  public function showOutputSyntax($show = true) {
    $outputVisibility = new VisibilityAdapter($this->outputSyntaxPane);
    $outputVisibility->setHidden(!$show);
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
    (new static($path, $highlightOutput, $outputLang))->printHtml();
  }

}
