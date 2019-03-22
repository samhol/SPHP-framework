<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Foundation\Sites\Containers\Accordions\ContentPane;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;
use Sphp\Html\Media\Icons\Filetype;
use Sphp\Html\Media\Icons\FA;
use Sphp\Html\Span;

/**
 * Implements an accordion builder for PHP Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CodeExampleAccordionBuilder extends AbstractContent {

  const HTMLFLOW = 'html';
  const OUTPUT_TEXT = 'text';
  const EXAMPLECODE = 'code';

  /**
   * @var atring[] 
   */
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
            ->allowMultiExpand()
            ->useDeepLinking();
    $accordion->cssClasses()->protectValue('sphp', 'code-example');
    $accordion->append($this->buildCodePane());
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
   * @param  string $lang
   * @param  bool $code
   * @return Span
   */
  public function buildIcons(string $lang, bool $code = false): Span {
    $span = new Span();
    $fa = new FA();
    $fa->fixedWidth(true);
    $span->addCssClass('icons');
    if ($lang === 'text') {
      $langIcon = $fa->terminal();
    } else {
      $langIcon = $fa->{$lang}();
    }
    $span->append($langIcon);
    if ($code) {
      $tag = $fa->code();
      $span->append($tag);
    }
    return $span;
  }

  /**
   * Builds and returns the highlighted output panel
   * 
   * @return SyntaxHighlightingPane new instance of the highlighted output panel
   */
  public function buildHighlightedOutput(): SyntaxHighlightingPane {
    if ($this->outputHl === null) {
      $this->outputHl = 'text';
    }
    $outputSyntaxPane = new SyntaxHighlightingPane();
    if ($this->outputHl === 'text') {
      $outputSyntaxPane->useDefaultContentCopyController(false);
      $icon = FA::terminal()->fixedWidth(true);
    } else {
      $outputSyntaxPane->useDefaultContentCopyController(true);
      $icon = Filetype::instance()->get($this->outputHl)->fixedWidth(true);
    }
    $outputSyntaxPane->setPaneTitle($this->buildIcons($this->outputHl, true) . ' ' . $this->titles[self::OUTPUT_TEXT]);
    //$outputSyntaxPane->executeFromFile($this->path, $this->outputHl);
    $outputSyntaxPane->setSource($this->data, $this->outputHl, true);
    return $outputSyntaxPane;
  }

  /**
   * Builds the HTML flow panel
   * 
   * @return ContentPane new instance of the HTML flow panel
   */
  public function buildHtmlFlow(): ContentPane {
    $outputPane = (new ContentPane())->addCssClass('html-output');
    $icon = \Sphp\Html\Media\Icons\FA::html5()->fixedWidth(true);
    $outputPane->setPaneTitle($icon . ' ' . $this->titles[self::HTMLFLOW]);
    $outputPane->append($this->data);
    return $outputPane;
  }

  /**
   * Builds and returns the code panel
   *
   * @return SyntaxHighlightingPane new instance of the code panel
   */
  public function buildCodePane(): SyntaxHighlightingPane {
    $codePane = new SyntaxHighlightingPane();
    $icon = Filetype::instance()->get('php')->fixedWidth(true);
    $codePane->setPaneTitle($icon . ' ' . $this->titles[self::EXAMPLECODE]);
    $codePane->loadFromFile($this->path);
    $codePane->addCssClass('code');
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
  public function setExamplePaneTitle(string $heading) {
    $this->titles[self::EXAMPLECODE] = $heading;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputSyntaxPaneTitle(string $title) {
    $this->titles[self::OUTPUT_TEXT] = $title;
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputPaneTitle(string $title) {
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
   * @throws RuntimeException if the code example path is given and contains no file
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
   * @throws RuntimeException if the code example path is given and contains no file
   * @return void
   */
  public static function visualize(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
    (new static($path, $highlightOutput, $outputAsHtmlFlow))->buildAccordion()->printHtml();
  }

}
