<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter;
/**
 * Description of SyntaxHighlightingTab
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SyntaxHighlightingTab extends GeSHiSyntaxHighlighter implements Tab {

  /**
   * @var BasicController 
   */
  private $tabButton;

  /**
   * Constructor
   * 
   * @param mixed $tab the tab button content
   * @param mixed $content the tab content
   */
  public function __construct($tab = null, $content = null) {
    parent::__construct();
    $this->identify();
    $this->cssClasses()->protectValue('tabs-panel');
    if ($content !== null) {
      $this->append($content);
    }
    $this->tabButton = new BasicController($tab, $this);
  }

  public function getController(): TabController {
    return $this->tabButton;
  }

  public function setActive(bool $visibility = true) {
    if ($visibility) {
      $this->addCssClass('is-active');
    } else {
      $this->removeCssClass('is-active');
    }
    $this->tabButton->setActive($visibility);
    return $this;
  }

}
