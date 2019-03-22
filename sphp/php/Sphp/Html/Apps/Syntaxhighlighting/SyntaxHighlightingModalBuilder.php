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
use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

/**
 * Implements Modal builder for program code Example presentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SyntaxHighlightingModalBuilder extends AbstractContent implements SyntaxHighlighter {

  use SyntaxhighlighterContainerTrait;

  /**
   * @var SyntaxHighlighter
   */
  private $hl;

  /**
   * @var Div 
   */
  private $title;

  /**
   * @var string|component 
   */
  private $trigger;

  /**
   * Constructor
   * 
   * @param string|component $trigger
   * @param type $title
   */
  public function __construct($trigger, $title = null) {
    $this->trigger = $trigger;
    $this->hl = new GeSHiSyntaxHighlighter();
    $this->title = $title;
    $this->title = new Div($title);
    $this->title->addCssClass('title');
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->hl);
  }

  public function getSyntaxHighlighter(): SyntaxHighlighter {
    return $this->hl;
  }

  /**
   * Builds a Foundation based Modal component containing the example
   * 
   * @return Modal a Foundation based Modal component containing the example
   */
  public function buildModal(): Modal {
    $popup = new Popup();
    $popup->addCssClass('sphp-syntax-highlighting-modal')->append($this->title);
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
    $this->title->setContent($heading);
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
   * @param type $button
   * @param type $title
   * @param string $path
   */
  public static function visualize($button, $title, string $path) {
    (new static($button, $title))->loadFromFile($path)->printHtml();
  }

}
