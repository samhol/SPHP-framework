<?php

/**
 * SyntaxhighlightingColumn.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\Apps\SyntaxhighlighterContainerTrait;

/**
 * Class implements Foundation framework based component to create  multi-device layouts
 *
 * The sum of the column widths in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SyntaxhighlightingColumn extends AbstractComponent implements ColumnInterface, SyntaxHighlighterInterface {

  use ColumnTrait, SyntaxhighlighterContainerTrait;
  
  /**
   *
   * @var SyntaxHighlighter 
   */
  private $syntaxHighlighter;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->lock("columns");
    $this->syntaxHighlighter = new SyntaxHighlighter();
  }

  public function __destruct() {
    unset($this->syntaxHighlighter);
    parent::__destruct();
  }
  
  /**
   * 
   * @return SyntaxHighlighter
   */
  public function getSyntaxHighlighter() {
    return $this->syntaxHighlighter;
  }

  public function contentToString() {
    return $this->syntaxHighlighter->getHtml();
  }

}
