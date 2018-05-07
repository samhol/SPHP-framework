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
use Sphp\Html\ComponentInterface;
use GeSHi;
use SqlFormatter;
use Gajus\Dindent\Indenter;
use Sphp\Html\Forms\Buttons\Button;
use Sphp\Html\Apps\ContentCopyController as CopyToClipboardButton;
use Sphp\Html\Div;
use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\Filesystem;
use Sphp\Html\Adapters\VisibilityAdapter;
use Sphp\Stdlib\Strings;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license https://opensource.org/licenses/MIT The MIT License
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @filesource
 */
class SyntaxHighlighter extends AbstractComponent implements SyntaxHighlighterInterface {

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
    $this->cssClasses()->protect('GeSHi', 'sphp-syntax-highlighter');
    $this->initGeshi();
    $this->setSyntaxBlockId();
    $footerText = 'Highlighted with <strong>GeSHi ' . $this->geshi->get_version() . '</strong>';
    $this->footer = (new Div($footerText))->addCssClass("foot");
    $this->buttonArea = (new Div())->addCssClass('button-area');
    $this->showLineNumbers(true)
            ->useFooter()
            ->setDefaultContentCopyController();
  }

  public function __destruct() {
    unset($this->codeContainer, $this->codeContainer, $this->geshi, $this->footer, $this->buttonArea);
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
    $output = $this->geshi->parse_code();
    $output .= $this->buttonArea . $this->footer;
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
   * @param  string $seed
   * @return $this for a fluent interface
   */
  public function setSyntaxBlockId($seed = "geshi_") {
    $this->geshiId = $seed . Strings::random();
    $this->geshi->set_overall_id($this->geshiId);
    return $this;
  }

  /**
   * Sets the linenumber visibility
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

  /**
   * Sets the copier button
   *
   * @param  null|ComponentInterface $button button or button content
   * @return ContentCopyController the attached button
   */
  public function attachContentCopyController(ComponentInterface $button = null) {
    if ($button === null) {
      $button = new Button($button);
    }
    $copyBtn = (new CopyToClipboardButton($button, $this->geshiId));
    return $copyBtn;
  }

  /**
   * Sets whether the copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return $this for a fluent interface
   */
  public function useDefaultContentCopyController(bool $use = true) {
    $vis = new VisibilityAdapter($this->copyBtn->getController());
    $vis->setHidden(!$use);
    return $this;
  }

  /**
   * Sets the copier button
   *
   * @param  mixed $button the copier button
   * @return $this for a fluent interface
   */
  public function setDefaultContentCopyController($button = 'Copy') {
    if (!$button instanceof ComponentInterface) {
      $button = new Button($button);
    }
    $this->copyBtn = $this->attachContentCopyController($button);
    $this->buttonArea['copy'] = $this->copyBtn;
    return $this;
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
