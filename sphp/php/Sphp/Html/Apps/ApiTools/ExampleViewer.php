<?php

/**
 * ExampleViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\ContentInterface as ContentInterface;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Apps\SingleAccordion as SingleAccordion;
use Sphp\Core\Types\BitMask as BitMask;
use Sphp\Core\Util\LocalFile as LocalFile;
use Gajus\Dindent\Indenter as Indenter;

/**
 * A Class for the PHP Example code and the preferred result
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-04-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExampleViewer implements ContentInterface {

  use ContentTrait;

  const SHOW_OUTPUT_SYNTAX = 0b1;
  const SHOW_OUTPUT_HTML = 0b10;
  const SHOW_ALL = 0b11;

  /**
   * the php code example presentation
   *
   * @var SyntaxHighlightingAccordion
   */
  private $inputViewer;

  /**
   * the output as a html element
   *
   * @var string
   */
  private $rawOutputString;

  /**
   * the output as a html element
   *
   * @var SingleAccordion
   */
  private $executedOutputViewer;

  /**
   * the output as highlighed syntax
   *
   * @var SyntaxHighlightingAccordion
   */
  private $outputSyntaxViewer;

  /**
   * Defines whether the output is viewed as program code is an
   * {@link SyntaxHighlighter} or as an html element
   *
   * @var BitMask
   */
  private $visibility;

  /**
   * Constructs a new instance
   *
   * @param string $path the filepath of the presented example PHP code
   * @param  boolean $visibility true for highlighted program code
   *         as the output presentation, false for html presentation
   * @param string $outputSyntaxType the language name of the output code
   */
  public function __construct($visibility = self::SHOW_OUTPUT_HTML) {
    $this->setComponentVisibility($visibility);
    $this->inputViewer = (new SyntaxHighlighter())
            ->setHeading("PHP code");
    $this->outputSyntaxViewer = (new SyntaxHighlighter());
    $this->executedOutputViewer = (new SingleAccordion())
            ->setHeading("Execution result as HTML5 document");
  }

  /**
   * Loads the example PHP file content
   *
   * @param  string $path the filepath of the example PHP code
   * @param  string $outputLang the language name of the highlighted output code
   * @return self for PHP Method Chaining
   */
  public function load($path, $outputLang = "html5") {
    $this->rawOutputString = (new LocalFile($path))->executeToString();
    $this->inputViewer->loadFromFile($path);
    $this->executedOutputViewer->body()->replaceContent($this->rawOutputString);
    if ($outputLang == "html5") {
      $in = new Indenter();
      $this->outputSyntaxViewer->setSource($in->indent($this->rawOutputString), $outputLang);
    } else if ($outputLang == "sql") {
      $this->outputSyntaxViewer->setSource(\SqlFormatter::format($this->rawOutputString, false), $outputLang);
    } else {
      $this->outputSyntaxViewer->setSource($this->rawOutputString, $outputLang);
    }
    $langName = self::getLangCode($outputLang);
    if ($langName != "TEXT") {
      $this->outputSyntaxViewer->setHeading("Execution result as $langName code");
    } else {
      $this->outputSyntaxViewer->setHeading("Execution result as plain formatted text");
    }
    return $this;
  }

  private static function getLangCode($outputLang) {
    return strtoupper($outputLang);
  }

  /**
   *
   * @return SyntaxHighlightingAccordion
   */
  public function getInputSyntaxViewer() {
    return $this->inputViewer;
  }

  /**
   * Returns the output syntax viewer
   *
   * @return SyntaxHighlightingAccordion
   */
  public function getOutputSyntaxViewer() {
    return $this->outputSyntaxViewer;
  }

  /**
   * Returns the output viewer
   *
   * @return SingleAccordion
   */
  public function getOutputViewer() {
    return $this->executedOutputViewer;
  }

  /**
   * Sets the output presentation as a highlighted program code or
   * as an html component
   *
   * @param  int $visibility a bitmask of components that are visible
   * @return self for PHP Method Chaining
   */
  public function setComponentVisibility($visibility) {
    $this->visibility = new BitMask($visibility);
    return $this;
  }

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Exception if the html parsing fails
   */
  public function getHtml() {
    $output = $this->inputViewer->getHtml();
    if ($this->visibility->contains(self::SHOW_OUTPUT_SYNTAX)) {
      $output .= $this->outputSyntaxViewer->getHtml();
    }
    if ($this->visibility->contains(self::SHOW_OUTPUT_HTML)) {
      $output .= $this->executedOutputViewer->getHtml();
    }
    return $output;
  }

  /**
   * Outputs the example in selected formats
   *
   * @param string $path the filepath of the presented example PHP code
   * @param int $visibleElements a bitmask of components that are visible
   * @param string $outputLang the language name of the highlighted output code
   */
  public function __invoke($path, $visibleElements = self::SHOW_ALL, $outputLang = "html5") {
    static::visualize($path, $outputLang, $visibleElements);
  }

  /**
   * Outputs the example in selected formats
   *
   * @param string $path the filepath of the presented example PHP code
   * @param string $outputLang the language name of the highlighted output code
   * @param int $visibleElements a bitmask of components that are visible
   */
  public static function visualize($path, $outputLang = "html5", $visibleElements = self::SHOW_ALL) {
    (new static($visibleElements))->load($path, $outputLang)->printHtml();
  }

  /**
   * Outputs the example in highlighted syntax
   *
   * @param string $path the filepath of the presented example PHP code
   * @param string $outputLang the language name of the highlighted output code
   */
  public static function visualizeSyntax($path, $outputLang = "html5") {
    (new static(self::SHOW_OUTPUT_SYNTAX))->load($path, $outputLang)->printHtml();
  }

  /**
   * Outputs the example in HTML
   *
   * @param string $path the filepath of the presented example PHP code
   */
  public static function visualizeHtml($path) {
    (new static(self::SHOW_OUTPUT_HTML))->load($path)->printHtml();
  }

  /**
   * Outputs the example in highlighted syntax and in HTML
   *
   * @param string $path the filepath of the presented example PHP code
   * @param string $outputLang the language name of the highlighted output code
   */
  public static function visualizeAll($path, $outputLang = "html5") {
    (new static(self::SHOW_ALL))->load($path, $outputLang)->printHtml();
  }

}
