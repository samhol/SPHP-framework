<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Content;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements an accordion builder for PHP Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CodeExampleAccordionBuilder implements Content {

  use \Sphp\Html\ContentTrait;

  const HTMLFLOW = 'html';
  const OUTPUT_TEXT = 'text';
  const EXAMPLECODE = 'code';

  private $titles = [];

  /**
   * @var string 
   */
  private $path;

  /**
   * @var string 
   */
  private $data;

  /**
   * @var boolean
   */
  private $showHtmlFlow = true;

  /**
   * @var string|null
   */
  private $outputHl = null;

  /**
   * Constructor
   *
   * @param  string $path the file path of the presented example PHP code
   * @param  string|null $highlightOutput the language name of the output code 
   *         or `null` if highlighted output code should not be visible
   * @param  boolean $outputAsHtmlFlow true for showing executed HTML flow
   * @throws RuntimeException if the code example path contains no file
   */
  public function __construct(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
    $this->setPath($path);
    $this->useDefaultTitles();
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
   * @param  boolean $outputAsHtmlFlow true for showing executed HTML flow
   * @return Accordion
   * @throws RuntimeException if the code example path contains no file
   */
  public function __invoke(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
    $this->setPath($path)
            ->setOutpputHighlighting($highlightOutput)
            ->setHtmlFlowVisibility($outputAsHtmlFlow);
    return $this->buildAccordion();
  }

  /**
   * Sets the path of the example code
   * 
   * @param  string $path the path of the example code
   * @return $this for a fluent interface
   * @throws RuntimeException if the code example path contains no file
   */
  public function setPath(string $path) {
    if (!Filesystem::isFile($path)) {
      throw new RuntimeException("The code example path '$path' contains no file");
    }
    $this->path = Filesystem::getFullPath($path);
    $this->data = Filesystem::executePhpToString($path);
    return $this;
  }

  /**
   * 
   * @param  string|null $highlightOutput
   * @return $this for a fluent interface
   */
  public function setOutpputHighlighting(string $highlightOutput = null) {
    $this->outputHl = $highlightOutput;
    return $this;
  }

  /**
   * 
   * @param  boolean $showHtmlFlow
   * @return $this for a fluent interface
   */
  public function setHtmlFlowVisibility(bool $showHtmlFlow) {
    $this->showHtmlFlow = $showHtmlFlow;
    return $this;
  }

  /**
   * Builds a Foundation based accordion component containing the example
   * 
   * @return Accordion a Foundation based accordion component containing the example
   */
  public function buildAccordion(): Accordion {
    $accordion = new Accordion();
    $accordion->allowAllClosed()
            ->allowMultiExpand();
    $accordion->cssClasses()->protect('manual');
    $accordion->append($this->getCodePane());
    if ($this->outputHl !== null) {
      $accordion->append($this->buildHighlightedOutput());
    }
    if ($this->showHtmlFlow) {
      $accordion->append($this->buildHtmlFlow());
    }
    return $accordion;
  }

  /**
   * 
   * @return SyntaxHighlightingPane
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function buildHighlightedOutput(): SyntaxHighlightingPane {
    if ($this->outputHl === null) {
      $this->outputHl = 'text';
    }
    $outputSyntaxPane = new SyntaxHighlightingPane();
    if ($this->outputHl === 'text') {
      $outputSyntaxPane->useDefaultContentCopyController(false);
    } else {
      $outputSyntaxPane->useDefaultContentCopyController(true);
    }
    $outputSyntaxPane->setPaneTitle($this->titles[self::OUTPUT_TEXT]);
    //$outputSyntaxPane->executeFromFile($this->path, $this->outputHl);
    $outputSyntaxPane->setSource($this->data, $this->outputHl, true);
    return $outputSyntaxPane;
  }

  /**
   * 
   * @return Pane
   */
  public function buildHtmlFlow(): Pane {
    $outputPane = (new Pane())->addCssClass('html-output');
    $outputPane->setPaneTitle($this->titles[self::HTMLFLOW]);
    $outputPane->append($this->data);
    return $outputPane;
  }

  /**
   * Returns the code panel
   *
   * @return SyntaxHighlightingPane
   */
  public function getCodePane(): SyntaxHighlightingPane {
    $codePane = (new SyntaxHighlightingPane());
    $codePane->setPaneTitle($this->titles[self::EXAMPLECODE]);
    $codePane->loadFromFile($this->path);
    return $codePane;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @return $this for a fluent interface
   */
  public function useDefaultTitles() {
    $this->titles[self::EXAMPLECODE] = 'PHP code';
    $this->titles[self::OUTPUT_TEXT] = 'Execution result as highlighted code';
    $this->titles[self::HTMLFLOW] = 'Execution result as HTML5 flow';
    return $this;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return $this for a fluent interface
   */
  public function setExamplePaneTitle($heading) {
    $this->titles[self::EXAMPLECODE] = $heading;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputSyntaxPaneTitle($title) {
    $this->titles[self::OUTPUT_TEXT] = $title;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputPaneTitle($title) {
    $this->titles[self::HTMLFLOW] = $title;
    return $this;
  }

  public function getHtml(): string {
    return $this->buildAccordion()->getHtml();
  }

  /**
   * Prints the PHP Example code and the preferred result
   *
   * @param  string $path the file path of the presented example PHP code
   * @param  string|null $highlightOutput the language name of the output code 
   *         or `null` if highlighted output code should not be visible
   * @param  boolean $outputAsHtmlFlow true for executed HTML result or false for no execution
   * @throws \Sphp\Exceptions\RuntimeException if the code example path is given and contains no file
   * @return CodeExampleAccordionBuilder
   */
  public static function build(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true): CodeExampleAccordionBuilder {
    return (new static($path, $highlightOutput, $outputAsHtmlFlow));
  }

  /**
   * Prints the PHP Example code and the preferred result
   *
   * @param  string $path the file path of the presented example PHP code
   * @param  string|null $highlightOutput the language name of the output code 
   *         or `null` if highlighted output code should not be visible
   * @param  boolean $outputAsHtmlFlow true for executed HTML result or false for no execution
   * @throws \Sphp\Exceptions\RuntimeException if the code example path is given and contains no file
   * @return Accordion
   */
  public static function visualize(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
    (new static($path, $highlightOutput, $outputAsHtmlFlow))->buildAccordion()->printHtml();
  }

}
