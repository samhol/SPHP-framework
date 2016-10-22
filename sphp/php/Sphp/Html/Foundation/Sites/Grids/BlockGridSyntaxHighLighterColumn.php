<?php

/**
 * BlockGridColumn.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Apps\SyntaxHighlighterInterface;
use Sphp\Html\Apps\SyntaxHighlighter;
use Sphp\Html\ComponentInterface;
/**
 * Class implements a Foundation Block Grid Column
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-26
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGridSyntaxHighLighterColumn extends AbstractComponent implements BlockGridColumnInterface, SyntaxHighlighterInterface {

  /**
   *
   * @var SyntaxHighlighter 
   */
  private $syntaxHighlighter;
  
  public function __construct($content = null) {
    parent::__construct('div');
    $this->cssClasses()->lock("column");
    $this->syntaxHighlighter = new SyntaxHighlighter();
  }

  public function contentToString() {
    return $this->syntaxHighlighter->getHtml();
  }

  public function attachContentCopyController(ComponentInterface $button = null) {
    return $this->syntaxHighlighter->attachContentCopyController($button);
  }

  public function loadFromFile($path) {
    return $this->syntaxHighlighter->loadFromFile($path);
  }

  public function setDefaultContentCopyController($content = "Copy") {
    return $this->syntaxHighlighter->loadFromFile($content);
  }

  public function setSource($source, $lang) {
    return $this->syntaxHighlighter->setSource($source, $lang);
  }

  public function useDefaultContentCopyController($use = true) {
    return $this->syntaxHighlighter->useDefaultContentCopyController($use);
  }

}
