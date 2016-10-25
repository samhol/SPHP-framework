<?php

/**
 * SyntaxHighlightingSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Headings\H2;

/**
 * Class implements a syntax highlighting slide for Foundation Orbit components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @filesource
 */
class SyntaxHighlightingSlide extends AbstractComponent implements SlideInterface, SyntaxHighlighterInterface {

  use \Sphp\Html\Apps\SyntaxhighlighterContainerTrait,
      ActivationTrait;

  /**
   *
   * @var H2
   */
  private $title;
  /**
   *
   * @var SyntaxHighlighterInterface 
   */
  private $hl;

  /**
   * Constructs a new instance
   * 
   * @param null|SyntaxHighlighterInterface $hl the inner syntax highlighting component
   */
  public function __construct(SyntaxHighlighterInterface $hl = null) {
    parent::__construct("li");
    $this->cssClasses()->lock(['orbit-slide', 'sphp-shl']);
    if ($hl === null) {
      $hl = new SyntaxHighlighter();
    }
    $this->hl = $hl;
    $this->title = new H2();
    $this->setHeading("code");
  }
  /**
   * 
   * @param type $content
   * @return \Sphp\Html\Foundation\Sites\Media\Orbit\SyntaxHighlightingSlide
   */
  public function setHeading($content) {
    $this->title->replaceContent($content);
    return $this;
  }

  /**
   * Returns the inner Syntax Highlighter component
   * 
   * @return SyntaxHighlighterInterface the inner Syntax Highlighter component
   */
  public function getSyntaxHighlighter() {
    return $this->hl;
  }

  public function contentToString() {
    return $this->title->getHtml() . $this->hl->getHtml();
  }

}
