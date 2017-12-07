<?php

/**
 * SyntaxhighlightingModalBuilder.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Content;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion;
use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingPane;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements aModal builder for PHP Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SyntaxhighlightingModalBuilder implements Content {

  use \Sphp\Html\ContentTrait,
      SyntaxhighlighterContainerTrait;

  /**
   * @var SyntaxHighlighterInterface
   */
  private $hl;

  /**
   * @var string 
   */
  private $title;

  /**
   * Constructs a new instance
   * 
   * @param type $trigger
   * @param type $title
   */
  public function __construct($trigger, $title = null) {
    $this->trigger = $trigger;
    $this->hl = new SyntaxHighlighter();
    $this->title = $title;
  }

  public function __destruct() {
    unset($this->hl);
  }

  /**
   * Builds a Foundation based Modal component containing the example
   * 
   * @return Modal a Foundation based Modal component containing the example
   */
  public function buildModal(): Modal {
    $popup = new Popup();
    $popup->append($this->title);
    $popup->append($this->hl);
    $modal = new Modal($this->trigger, $popup);
    return $modal;
  }

  /**
   * Sets the heading of the example PHP code component
   *
   * @param  string $heading the heading of the example PHP code
   * @return $this for a fluent interface
   */
  public function setTitle($heading) {
    $this->title = $heading;
    return $this;
  }

  public function getHtml(): string {
    return $this->buildModal()->getHtml();
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
  public static function visualize(string $title, string $path) {
    (new static($path, $highlightOutput, $outputAsHtmlFlow))->buildAccordion()->printHtml();
  }

  public function getSyntaxHighlighter(): SyntaxHighlighterInterface {
    return $this->hl;
  }

}
