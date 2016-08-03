<?php

/**
 * SyntaxHighlighter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\ComponentInterface as ComponentInterface;
use GeSHi;
use Sphp\Html\Forms\Buttons\ButtonTag as Button;
use Sphp\Html\Apps\ContentCopyController as CopyToClipboardButton;
use Sphp\Core\Types\Arrays as Arrays;
use Sphp\Html\Div as Div;

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
class SyntaxHighlighter extends AbstractContainerComponent implements SyntaxHighlighterInterface {

  /**
   * the GeSHi component
   *
   * @var GeSHi
   */
  private $geshi;

  /**
   * GeSHi settings
   *
   * @var array
   */
  private $geshiProps = [];

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
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct("div");
    //$this->geshi = new GeSHi();
    $this->cssClasses()->lock("GeSHi sphp-syntax-highlighter");
    $this->content()->set("buttons", "");
    $this->codeContainer = (new Div())->identify();
    $this->content()->set("code", $this->codeContainer);
    $this->buildGeshi();
    $this->showLineNumbers(TRUE)
            ->startLineNumbersAt(1)
            ->useFooter()
            ->setDefaultContentCopyController();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    throw new Exception();
    parent::__clone();
    $this->geshiProps = Arrays::copy($this->geshiProps);
    $this->buildGeshi();
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    if (array_key_exists("load_from_file", $this->geshiProps) || array_key_exists("set_source", $this->geshiProps)) {
      $this->codeContainer->replaceContent($this->geshi->parse_code());
    }
    return parent::getHtml();
  }

  /**
   * Builds the GeSHi - Generic Syntax Highlighter object
   *
   * @return GeSHi the GeSHi - Generic Syntax Highlighter object
   */
  private function buildGeshi() {
    $this->geshi = new GeSHi();
    $this->geshi->enable_classes();
    $this->geshi->set_overall_class("syntax");
    $this->geshi->set_header_type(GESHI_HEADER_DIV);
    foreach ($this->geshiProps as $method_name => $params) {
      if (!is_array($params)) {
        $params = [$params];
      }
      call_user_func_array([$this->geshi, $method_name], $params);
    }
    return $this->geshi;
  }

  /**
   * 
   * @param  string $fun
   * @param  mixed $params
   * @return self for PHP Method Chaining
   */
  protected function setGeshiProperties($fun, $params) {
    if ($fun === "load_from_file") {
      unset($this->geshiProps["set_source"], $this->geshiProps["set_language"]);
      $this->buildGeshi();
    }
    if ($fun === "set_source") {
      unset($this->geshiProps["load_from_file"]);
      $this->buildGeshi();
    }
    $this->geshiProps[$fun] = $params;
    if (!is_array($params)) {
      $params = [$params];
    }
    call_user_func_array([$this->geshi, $fun], $params);
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getSyntaxBlockId() {
    return $this->codeContainer->getId();
  }

  /**
   * S
   * 
   * @param  int $number
   * @return self for PHP Method Chaining
   */
  public function startLineNumbersAt($number) {
    $this->setGeshiProperties("start_line_numbers_at", $number);
    return $this;
  }

  /**
   * 
   * @param  boolean $show
   * @return self for PHP Method Chaining
   */
  public function showLineNumbers($show = TRUE) {
    if ($show) {
      $this->setGeshiProperties("enable_line_numbers", [GESHI_FANCY_LINE_NUMBERS, 2]);
    } else {
      $this->setGeshiProperties("enable_line_numbers", [GESHI_NO_LINE_NUMBERS]);
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
      $footerText = "Highlighted with <strong>GeSHi " . $this->geshi->get_version() . "</strong>";
      $footerText = (new Div($footerText))->addCssClass("foot");
    } else {
      $footerText = "";
    }
    $this->content()->set("footer", $footerText);
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
    $copyBtn = (new CopyToClipboardButton($button, $this->codeContainer));
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
      $this->content()["button-area"]->show();
    } else {
      $this->content()["button-area"]->hide();
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
    $buttonArea = new Div($this->copyBtn);
    $buttonArea->cssClasses()->lock("button-area");
    $this->content()["button-area"] = $buttonArea;
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function setSource($source, $lang) {
    $this->setGeshiProperties("set_source", [$source]);
    $this->setGeshiProperties("set_language", [$lang]);
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function loadFromFile($filename) {
    if (!file_exists($filename)) {
      throw new \Exception("The file '$filename' does not exist!");
    }
    $this->setGeshiProperties("load_from_file", [$filename]);
    return $this;
  }

}
