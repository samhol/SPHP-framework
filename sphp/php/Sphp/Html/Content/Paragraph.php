<?php

/**
 * Paragraph.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Content;

use Sphp\Html\ContainerTag;
use Sphp\Html\AjaxLoader;

/**
 * Implements an HTML &lt;p&gt; tag
 *
 *  This component represents a paragraph in an HTML document.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_p.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-p-element W3C HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Paragraph extends ContainerTag implements AjaxLoader {

  use \Sphp\Html\AjaxLoaderTrait;

  /**
   * Constructs a new instance
   *
   * @param  mixed $content optional content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('p', $content);
  }

  public function __invoke($content = null) {
    $this->replaceContent($content);
    return $this;
  }
  
  public function appendMd(string $md) {
    $parsed = \ParsedownExtraPlugin::instance()->line($md);
    $this->append($parsed);
    return $this;
  }

}
