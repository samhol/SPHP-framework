<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Component;
use GeSHi;
use SqlFormatter;
use Gajus\Dindent\Indenter;
use Sphp\Html\Forms\Buttons\Button;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\FA;
use Sphp\Html\Apps\ContentCopyController;
use Sphp\Html\Div;
use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\Filesystem;
use Sphp\Html\Adapters\VisibilityAdapter;
use Sphp\Html\Attributes\IdStorage;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license https://opensource.org/licenses/MIT The MIT License
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class GeSHiSyntaxHighlighter extends AbstractComponent implements SyntaxHighlighter {

  /**
   * the GeSHi component
   *
   * @var GeSHi
   */
  private $geshi;

  /**
   * default copy button
   *
   * @var ContentCopyController 
   */
  private $copyBtn;

  /**
   * code containing component
   *
   * @var Div 
   */
  private $codeContainer;

  /**
   * button controllers containing component
   *
   * @var Div 
   */
  private $buttonArea;

  /**
   * footer component
   *
   * @var Div 
   */
  private $head;

  /**
   * footer component
   *
   * @var Div 
   */
  private $footer;

  /**
   * @var string 
   */
  private $geshiId;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protectValue('GeSHi', 'sphp-syntax-highlighter');
    $this->initGeshi();
    $this->setSyntaxBlockId();
    $footerText = 'Highlighted with <strong>GeSHi ' . $this->geshi->get_version() . '</strong>';
    $this->buttonArea = (new Div())->addCssClass('button-area');
    $this->head = (new Div($this->buttonArea))->addCssClass('head-area');
    $this->footer = (new Div($footerText))->addCssClass('foot-area');
    $this->showLineNumbers(true)
            ->useFooter()
            ->setContentCopyController(Tags::span(FA::copy())->addCssClass('sphp', 'copy-button'));
  }

  public function __destruct() {
    unset($this->codeContainer, $this->geshi, $this->footer, $this->buttonArea);
    parent::__destruct();
  }

  public function __clone() {
    throw new Exception();
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  private function initGeshi() {
    $this->geshi = new GeSHi();
    $this->geshi->enable_classes();
    $this->geshi->set_overall_class('syntax');
    $this->geshi->set_header_type(GESHI_HEADER_DIV);
    //$this->geshi->set_overall_id(\Sphp\Stdlib\Strings::random());
    return $this;
  }

  public function contentToString(): string {
    $output = $this->head;
    $output .= $this->geshi->parse_code();
    $output .= $this->footer;
    return $output;
  }

  /**
   * 
   * @return string
   */
  public function getSyntaxBlockId() {
    return $this->geshiId;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function setSyntaxBlockId() {
    $this->geshiId = IdStorage::get('id')->generateRandom();
    $this->geshi->set_overall_id($this->geshiId);
    return $this;
  }

  /**
   * Sets the line number visibility
   * 
   * @param  boolean $show true for visible line numbers and false otherwise
   * @return $this for a fluent interface
   */
  public function showLineNumbers(bool $show = true) {
    if ($show) {
      $this->geshi->enable_line_numbers(\GESHI_FANCY_LINE_NUMBERS, 2);
    } else {
      $this->geshi->enable_line_numbers(\GESHI_NO_LINE_NUMBERS);
    }
    return $this;
  }

  /**
   * Sets whether the footer is visible or not
   *
   * @param  boolean $use true the footer is visible, false otherwise
   * @return $this for a fluent interface
   */
  public function useFooter(bool $use = true) {
    $vis = new VisibilityAdapter($this->footer);
    $vis->setHidden(!$use);
    return $this;
  }

  public function attachContentCopyController(Component $controller): ContentCopyController {
    $copyBtn = (new ContentCopyController($controller, $this->geshiId));
    return $copyBtn;
  }

  public function useDefaultContentCopyController(bool $use = true) {
    $vis = new VisibilityAdapter($this->copyBtn->getController());
    $vis->setHidden(!$use);
    return $this;
  }

  public function setContentCopyController(Component $button): ContentCopyController {
    $this->copyBtn = $this->attachContentCopyController($button);
    $this->head['copy'] = $this->copyBtn;
    return $this->copyBtn;
  }

  /**
   * 
   * @param string $source
   * @param string $lang
   * @return string
   */
  protected function formatCode(string $source, string $lang): string {
    if ($lang == 'html5') {
      $indenter = new Indenter();
      $source = $indenter->indent($source);
    } else if ($lang == 'sql') {
      $source = SqlFormatter::format($source, false);
    }
    return $source;
  }

  public function setSource(string $source, string $lang, bool $format = false) {
    if ($format) {
      $source = $this->formatCode($source, $lang);
    }
    $this->geshi->set_source($source);
    $this->geshi->set_language($lang);
    return $this;
  }

  public function loadFromFile(string $filename) {
    try {
      $path = Filesystem::getFullPath($filename);
      $this->geshi->load_from_file($path);
      return $this;
    } catch (\Exception $ex) {
      throw new RuntimeException("The file '$filename' does not exist!", $ex->getCode(), $ex);
    }
  }

  public function executeFromFile(string $path, string $lang = 'text') {
    if (!file_exists($path)) {
      throw new RuntimeException("The file in the '$path' does not exist!");
    }
    $source = Filesystem::executePhpToString($path);
    if ($lang == 'html5') {
      $source = (new Indenter())->indent($source);
    } else if ($lang == 'sql') {
      $source = SqlFormatter::format($source, false);
    }
    $this->setSource($source, $lang);
    return $this;
  }

}
