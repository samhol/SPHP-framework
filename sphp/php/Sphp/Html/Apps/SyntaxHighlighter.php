<?php

/**
 * SyntaxHighlighter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractComponent;
use Sphp\Html\ComponentInterface;
use GeSHi;
use SqlFormatter;
use Gajus\Dindent\Indenter;
use Sphp\Html\Forms\Buttons\ButtonTag as Button;
use Sphp\Html\Apps\ContentCopyController as CopyToClipboardButton;
use Sphp\Html\Div;
use InvalidArgumentException;
use Sphp\Core\Util\FileUtils;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   *
   * @var string 
   */
  private $geshiId;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->lock("GeSHi sphp-syntax-highlighter");
    $this->initGeshi();
    $this->setSyntaxBlockId();
    $footerText = "Highlighted with <strong>GeSHi " . $this->geshi->get_version() . "</strong>";
    $this->footer = (new Div($footerText))->addCssClass("foot");
    $this->buttonArea = (new Div())->addCssClass("button-area");
    $this->showLineNumbers(TRUE)
            ->startLineNumbersAt(1)
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
   * @return self for PHP Method Chaining
   */
  private function initGeshi() {
    $this->geshi = new GeSHi();
    $this->geshi->enable_classes();
    $this->geshi->set_overall_class("syntax");
    $this->geshi->set_header_type(GESHI_HEADER_DIV);
    //$this->geshi->set_overall_id(\Sphp\Core\Types\Strings::random());
    return $this;
  }

  public function contentToString() {
    $output = "";
    $output .= $this->geshi->parse_code();
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
   * @return self for PHP Method Chaining
   */
  public function setSyntaxBlockId($seed = "geshi_") {
    $this->geshiId = $seed . \Sphp\Core\Types\Strings::random();
    $this->geshi->set_overall_id($this->geshiId);
    return $this;
  }

  /**
   * S
   * 
   * @param  int $number
   * @return self for PHP Method Chaining
   */
  public function startLineNumbersAt($number) {
    $this->geshi->start_line_numbers_at($number);
    return $this;
  }

  /**
   * 
   * @param  boolean $show
   * @return self for PHP Method Chaining
   */
  public function showLineNumbers($show = TRUE) {
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
   * @return self for PHP Method Chaining
   */
  public function useFooter($use = true) {
    if ($use) {
      $this->footer->unhide();
    } else {
      $this->footer->hide();
    }
    return $this;
  }

  /**
   * Sets the copier button
   *
   * @param  null|ComponentInterface $button button or button content
   * @return ContentCopyController the attached putton
   */
  public function attachContentCopyController(ComponentInterface $button = null) {
    if ($button === null) {
      $button = new Button("button", $button);
    }
    $copyBtn = (new CopyToClipboardButton($button, $this->geshiId));
    return $copyBtn;
  }

  /**
   * Sets whether the copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return self for PHP Method Chaining
   */
  public function useDefaultContentCopyController($use = true) {
    if ($use) {
      $this->copyBtn->getController()->unhide();
    } else {
      $this->copyBtn->getController()->hide();
    }
    return $this;
  }

  /**
   * Sets the copier button
   *
   * @param  mixed $button the copier button
   * @return self for PHP Method Chaining
   */
  public function setDefaultContentCopyController($button = "copy") {
    if (!($button instanceof ComponentInterface)) {
      $button = new Button("button", $button);
    }
    $this->copyBtn = $this->attachContentCopyController($button);
    $this->buttonArea["copy"] = $this->copyBtn;
    return $this;
  }

  public function setLanguage($lang) {
    $this->geshi->set_language($lang);
    return $this;
  }

  public function setSource($source, $lang) {
    $this->geshi->set_source($source);
    $this->geshi->set_language($lang);
    return $this;
  }

  public function loadFromFile($filename) {
    if (!file_exists($filename)) {
      throw new InvalidArgumentException("The file '$filename' does not exist!");
    }
    $this->geshi->load_from_file($filename);
    return $this;
  }

  /**
   * 
   * @param  string $path
   * @param  string $lang
   * @return self for PHP Method Chaining
   * @throws InvalidArgumentException
   */
  public function executeFromFile($path, $lang = "text") {
    if (!file_exists($path)) {
      throw new InvalidArgumentException("The file in the '$path' does not exist!");
    }
    $source = FileUtils::executePhpToString($path);
    if ($lang == "html5") {
      $source = (new Indenter())->indent($source);
    } else if ($lang == "sql") {
      $source = SqlFormatter::format($source, false);
    }
    $this->setSource($source, $lang);
    return $this;
  }

}
