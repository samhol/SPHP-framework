<?php

/**
 * SyntaxHighlightingAccordion.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Core\Types\Strings as Strings;
use Sphp\Html\ComponentInterface as ComponentInterface;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter) with a {@link AbstractComponent}
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-24
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @filesource
 */
class SyntaxHighlightingAccordion extends AbstractSingleAccordion implements SyntaxHighlighterInterface {

  /**
   * the DOM id of the GeSHi component
   *
   * @var string
   */
  private $geshiId;

  /**
   *
   * @var SyntaxHighlighter
   */
  private $hl;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->hl = new SyntaxHighlighter();
    $this->hl->useDefaultContentCopyController(false);
    $this->geshiId = "geshi_" . Strings::generateRandomString();
    parent::__construct();
    $this->cssClasses()->lock("GeSHi");
    $this->build();
    $this->attrs()->set("data-sphp-single-accordion", "syntaxHighlighter");
    $this->cssClasses()->lock("sphp-single-accordion");
    $this
            ->useCopyToClipboardButton();
  }

  /**
   * The inner component builder
   *
   * @return self for PHP Method Chaining
   */
  private function build() {
    $this->body()["geshi"] = $this->hl;
    $this->setHeading("Highlighted code");
    $this->head()->set("copier", "");
    return $this;
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighter the inner Syntax Highlighter component
   */
  public function getHighlighter() {
    return $this->hl;
  }

  /**
   * Sets whether the copy button is in use or not
   *
   * @param  boolean $use true if the button is in use, false otherwise
   * @return self for PHP Method Chaining
   */
  public function useCopyToClipboardButton($use = true) {
    if ($use) {
      $button = new \Sphp\Html\Forms\Buttons\ButtonTag("button", "copy");
      $button->addCssClass("copy")
              ->setTitle("Copy to clipboard")
              ->setStyle("display", "none");
      $copyBtn = $this->hl->attachContentCopyController($button);
      $this->head()->set("copier", $copyBtn);
    } else {
      $this->head()->set("copier", "");
    }
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function setSource($source, $lang) {
    $this->hl->setSource($source, $lang);
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function loadFromFile($filename) {
    $this->hl->loadFromFile($filename);
    return $this;
  }

  /**
   * @inheritdoc
   */
  public function __clone() {
    parent::__clone();
    $this->hl = clone $this->hl;
  }

  public function attachContentCopyController(ComponentInterface $button = null) {
    
  }

  public function setDefaultContentCopyController($button = "copy") {
    
  }

  public function useDefaultContentCopyController($use = true) {
    
  }

}
