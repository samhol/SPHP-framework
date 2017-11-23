<?php

/**
 * FoundationDocsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Hyperlink generator pointing to online Foundation Documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FoundationDocsLinker extends AbstractLinker {

  /**
   * Constructs a new instance
   * 
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   */
  public function __construct(string $defaultTarget = null) {
    parent::__construct(new UrlGenerator('http://foundation.zurb.com/sites/docs/'), $defaultTarget);
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
    return $this->hyperlink($this->urls()->create(strtolower($page)), $text, $title);
  }

}
