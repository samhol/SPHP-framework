<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Hyperlink generator pointing to online Foundation Documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FoundationDocsLinker extends AbstractLinker {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct(new UrlGenerator('http://foundation.zurb.com/sites/docs/'));
  }

  /**
   * Returns a hyperlink object pointing to the Foundation documentation
   * 
   * @param  string $object the name of the Foundation doc
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function __get(string $object): Hyperlink {
    $page = str_replace('_', '-', $object) . '.html';
    $text = str_replace('_', ' ', $object);
    $title = 'Foundation sites: ' . str_replace('_', ' ', $object);
    return $this->hyperlink($this->urls()->createUrl(strtolower($page)), $text, $title);
  }

}
