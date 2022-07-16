<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Accordions\ContentPane;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Bootstrap\Components\Accordions\Accordion;
use Sphp\Bootstrap\Components\Accordions\Pane;
use Sphp\Stdlib\MessageManager;

/**
 * Implements an accordion builder for PHP Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PHPExampleRunner extends AbstractContent {

  private SyntaxHighlighter $hl;
  private string $path;
  private ?string $data;
  private string $codeTitle;
  private string $outputTitle;
  private string $htmlFlowTitle;
  private bool $showHtmlFlow = true;
  private bool $showCodeOutput = true;
  private MessageManager $headigs;

  public const EXAMPLE = 1;
  public const CODE_OUTPUT = 2;
  public const HTML_FLOW_OUTPUT = 3;

  /**
   * @var string|null
   */
  private ?string $outputLanguage = 'text';

  /**
   * Constructor
   *
   * @param SyntaxHighlighter $hl 
   */
  public function __construct(SyntaxHighlighter $hl) {
    $this->headigs = new MessageManager();
    $this->headigs->setTemplate(self::EXAMPLE, 'PHP Example Code');
    $this->headigs->setTemplate(self::CODE_OUTPUT, 'Execution result as :lang output');
    $this->headigs->setTemplate(self::HTML_FLOW_OUTPUT, 'Example result as HTML Flow');
    $this->hl = $hl;
    $this->codeTitle = 'PHP Code';
    $this->outputTitle = 'Execution result as %s';
    $this->htmlFlowTitle = 'HTML Flow';
    $this->data = null;
  }

  public function __destruct() {
    unset($this->hl, $this->headigs);
  }

  /**
   * 
   * @param  string $path the file path of the presented example PHP code
   * @param  string|null $highlightOutput 
   *         output presentation, false for html presentation
   * @param  bool $outputAsHtmlFlow true for showing executed HTML flow
   * @return Accordion
   * @throws RuntimeException if the code example path contains no file
   */
  public function __invoke(string $path, ?string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
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
   * @throws InvalidArgumentException if the path contains no file
   */
  public function setPath(string $path) {
    if (!Filesystem::isFile($path)) {
      throw new InvalidArgumentException("The code example path '$path' contains no file");
    }
    $this->path = $path;
    $this->data = Filesystem::executePhpToString($path);
    return $this;
  }

  /**
   * 
   * @param  string|null $highlightOutput
   * @return $this for a fluent interface
   */
  public function setOutpputHighlighting(?string $highlightOutput) {
    $this->outputLanguage = $highlightOutput;
    return $this;
  }

  /**
   * 
   * @param  bool $showHtmlFlow
   * @return $this for a fluent interface
   */
  public function setHtmlFlowVisibility(bool $showHtmlFlow) {
    $this->showHtmlFlow = $showHtmlFlow;
    return $this;
  }

  /**
   * Builds an accordion component containing the example
   * 
   * @return Accordion an accordion component containing the example
   */
  public function buildAccordion(): Accordion {
    $accordion = new Accordion();
    $accordion->append($this->buildCodePane());
    if ($this->showCodeOutput && $this->outputLanguage !== null) {
      $accordion->append($this->buildHighlightedOutput());
    }
    if ($this->showHtmlFlow) {
      $accordion->append($this->buildHtmlFlow());
    }
    return $accordion;
  }

  /**
   * Builds and returns the highlighted output panel
   * 
   * @return Pane new instance of the highlighted output panel
   */
  public function buildHighlightedOutput(): Pane {
    if ($this->outputLanguage === 'html' || $this->outputLanguage === 'html5') {
      $formatter = new \Sphp\Filters\HtmlIntender();
      $data = $formatter->filter($this->data);
    } else {
      $data = $this->data;
    }
    $title = $this->headigs->buildMessageFromTemplate(
            self::CODE_OUTPUT,
            ['lang' => strtoupper($this->outputLanguage)]);
    $pane = new ContentPane($title, $this->hl->blockFromString($data, $this->outputLanguage));
    return $pane;
  }

  /**
   * Builds the HTML flow panel
   * 
   * @return Pane new instance of the HTML flow panel
   */
  public function buildHtmlFlow(): Pane {
    $title = $this->headigs->buildMessageFromTemplate(self::HTML_FLOW_OUTPUT);
    $pane = new ContentPane($title, $this->data);
    return $pane;
  }

  /**
   * Builds and returns the code panel
   *
   * @return Pane new instance of the code panel
   */
  public function buildCodePane(): Pane {
    $title = $this->headigs->buildMessageFromTemplate(self::EXAMPLE);
    $codePane = new ContentPane($title, $this->hl->blockFromFile($this->path));
    return $codePane;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return $this for a fluent interface
   */
  public function setExamplePaneTitle(string $heading) { 
    $this->headigs->setTemplate(self::EXAMPLE, $heading);
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputSyntaxPaneTitle(string $title) {
    $this->headigs->setTemplate(self::CODE_OUTPUT, $title);
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $title the heading of the output component
   * @return $this for a fluent interface
   */
  public function setOutputPaneTitle(string $title) {
    $this->headigs->setTemplate(self::HTML_FLOW_OUTPUT, $title);
    return $this;
  }

  public function getHtml(): string {
    return $this->buildAccordion()->getHtml();
  }

}
