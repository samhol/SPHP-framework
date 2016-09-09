<?php

/**
 * ExampleViewingBlockGrid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Apps\SyntaxHighlighterInterface as SyntaxHighlighterInterface;
use Sphp\Html\Div as Div;

/**
 * Class ExampleViewingBlockGrid
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-05
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ExampleViewingGrid extends AbstractComponent implements SyntaxHighlighterInterface {

  use ContentTrait;

  /**
   *
   * @var Div 
   */
  private $heading;

  /**
   *
   * @var Grid 
   */
  private $blockGrid;

  /**
   *
   * @var SyntaxhighlightingColumn
   */
  private $syntaxHighlighter;

  /**
   *
   * @var Column 
   */
  private $result;

  /**
   * 
   * @param  mixed $heading column width for small screens (1-2)
   */
  public function __construct($heading = "Example") {
    parent::__construct("div");
    $this->cssClasses()->lock("sphp-code-example-grid");
    $this->syntaxHighlighter = new SyntaxhighlightingColumn();
    $this->result = new Column();
    $this->result->cssClasses()->lock("result");
    $this->heading = new Div();
    $this->heading->cssClasses()->lock("heading");
    $this->blockGrid = new Row([$this->syntaxHighlighter, $this->result]);
    $this->blockGrid->addCssClass("collapse");
    $this->setHeading($heading);
    $this->setRatio(12, "small");
    $this->setRatio(8, "xlarge");
  }

  /**
   * 
   * @param  int $syntaxSize
   * @param  string $screen
   * @return self for PHP Method Chaining
   */
  public function setRatio($syntaxSize, $screen) {
    if ($syntaxSize < 12) {
      $result = 12 - $syntaxSize;
    } if ($syntaxSize >= 12) {
      $syntaxSize = 12;
      $result = 12;
    }
    $this->syntaxHighlighter->setWidth($syntaxSize, $screen);
    $this->result->setWidth($result, $screen);
    return $this;
  }

  /**
   * Sets the heading for the example 
   * 
   * @param  mixed $heading
   * @return self for PHP Method Chaining
   */
  public function setHeading($heading) {
    $this->heading->replaceContent($heading);
    return $this;
  }

  /**
   * Sets the heading for the example 
   * 
   * @param  mixed $footer
   * @return self for PHP Method Chaining
   */
  public function setFooter($footer) {
    $this->heading->replaceContent($footer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function attachContentCopyController(ComponentInterface $button = null) {
    return $this->syntaxHighlighter->attachContentCopyController($button);
  }

  /**
   * {@inheritdoc}
   */
  public function loadFromFile($path) {
    $this->syntaxHighlighter->loadFromFile($path);  
    $this->result->clear()->appendPhpFile($path);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setDefaultContentCopyController($content = "Copy") {
    return $this->syntaxHighlighter->setDefaultContentCopyController($content);
  }

  /**
   * {@inheritdoc}
   */
  public function setSource($source, $lang) {
    $this->syntaxHighlighter->setSource($source, $lang);
    $this->result->clear()->append($source);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function useDefaultContentCopyController($use = true) {
    $this->syntaxHighlighter->useDefaultContentCopyController($use);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->heading . $this->blockGrid->getHtml() . "<div class='footer'>footer</div>";
  }

}
