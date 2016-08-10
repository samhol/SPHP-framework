<?php

/**
 * PHPExampleViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\ContentInterface as ContentInterface;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Apps\SingleAccordion as SingleAccordion;
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
class PHPExampleViewer implements ContentInterface {

  use ContentTrait;

  /**
   * the php code example presentation
   *
   * @var SyntaxHighlightingAccordion
   */
  private $phpSyntax;

  /**
   * the output as a html element
   *
   * @var SingleAccordion
   */
  private $output;

  /**
   * the output as highlighed syntax
   *
   * @var SyntaxHighlightingAccordion
   */
  private $outputSyntax;

  /**
   * Defines whether the output is viewed as program code is an
   * {@link SyntaxHighlighter} or as an html element
   *
   * @var boolean
   */
  private $highlightOutput = false;

  /**
   * Constructs a new instance
   *
   * @param string $path the filepath of the presented example PHP code
   * @param  boolean $highlightOutput true for highlighted program code
   *         as the output presentation, false for html presentation
   * @param string $outputSyntaxType the language name of the output code
   */
  public function __construct($path = null, $highlightOutput = false, $outputSyntaxType = "html5") {
    $this->highlightOutput($highlightOutput);
    $this->phpSyntax = (new SyntaxHighlighter())
            ->setHeading("PHP code");
    $this->outputSyntax = new SyntaxHighlighter();
    $this->output = new SingleAccordion();
    $this->setOutputHeading("Execution result");
    if ($path !== null) {
      $this->fromFile($path, $highlightOutput, $outputSyntaxType);
    }
  }

  /**
   * Loads the example PHP code from a PHP string
   *
   * @param  string $string the example PHP code string
   * @param  boolean $highlightOutput true for highlighted program code
   *         as the output presentation, false for html presentation
   * @param  string $outputLang the language name of the highlighted output code
   * @return self for PHP Method Chaining
   */
  public function fromString($string, $highlightOutput = false, $outputLang = "html5") {
    $this->highlightOutput($highlightOutput);
    $this->phpSyntax->setSource($string, "php");
    $this->output->body()->replaceContent($string);
    if ($outputLang == "html5") {
      $in = new Indenter();
      $html = $in->indent($string);
      $this->outputSyntax->setSource($html, $outputLang);
    } else if ($outputLang == "sql") {
      $this->outputSyntax->setSource(\SqlFormatter::format($string, false), $outputLang);
    } else {
      $this->outputSyntax->setSource($string, $outputLang);
    }
    return $this;
  }

  /**
   * Loads the example PHP file content
   *
   * @param  string $path the filepath of the example PHP code
   * @param  boolean $highlightOutput true for highlighted program code
   *         as the output presentation, false for html presentation
   * @param  string $outputLang the language name of the highlighted output code
   * @return self for PHP Method Chaining
   */
  public function fromFile($path, $highlightOutput = false, $outputLang = "html5") {
    $this->highlightOutput($highlightOutput);
    $output = (new LocalFile($path))->executeToString();
    $this->phpSyntax->loadFromFile($path);
    $this->output->body()->replaceContent($output);
    if ($outputLang == "html5") {
      $in = new Indenter();
      //echo $in->indent($output);
      $this->outputSyntax->setSource($in->indent($output), $outputLang);
    } else if ($outputLang == "sql") {
      $this->outputSyntax->setSource(\SqlFormatter::format($output, false), $outputLang);
    } else {
      $this->outputSyntax->setSource($output, $outputLang);
    }
    return $this;
  }

  /**
   *
   * @return SyntaxHighlightingAccordion
   */
  public function getCodeViewer() {
    return $this->phpSyntax;
  }

  /**
   *
   * @return SingleAccordion
   */
  public function getOutputViewer() {
    return $this->output;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return self for PHP Method Chaining
   */
  public function setExampleHeading($heading) {
    $this->phpSyntax->setHeading($heading);
    return $this;
  }

  /**
   * Sets the the heading of the output component
   *
   * @param  string $heading the heading of the output component
   * @return self for PHP Method Chaining
   */
  public function setOutputHeading($heading) {
    $this->output->setHeading($heading);
    $this->outputSyntax->setHeading($heading);
    return $this;
  }

  /**
   * Checks whether the output is presented as a highlighted program code or
   * as an html component
   *
   * @return boolean true for highlighted program code presentation, false
   *         for html presentation
   */
  public function isOutputHighlighted() {
    return $this->highlightOutput;
  }

  /**
   * Sets the output presentation as a highlighted program code or
   * as an html component
   *
   * @param  boolean $highlight true for highlighted program code
   *         presentation, false for html presentation
   * @return self for PHP Method Chaining
   */
  public function highlightOutput($highlight = true) {
    $this->highlightOutput = $highlight;
    return $this;
  }

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws \Exception if the html parsing fails
   */
  public function getHtml() {
    $output = $this->phpSyntax->getHtml();
    if ($this->isOutputHighlighted()) {
      return $output . $this->outputSyntax->getHtml();
    } else {
      return $output . $this->output->getHtml();
    }
  }

  /**
   * Prints the PHP Example code and the preferred result
   *
   * @param  string $path the filepath of the presented example PHP code
   * @param  boolean $highlightOutput true for highlighted program code
   *         presentation, false for html presentation
   * @param string $outputLang the language name of the highlighted output code
   */
  public static function visualize($path, $highlightOutput = false, $outputLang = "html5") {
    (new PHPExampleViewer())->fromFile($path, $highlightOutput, $outputLang)->printHtml();
  }

}
