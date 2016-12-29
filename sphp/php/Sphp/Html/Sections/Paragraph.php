<?php

/**
 * Paragraph.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Sections;

use Sphp\Html\ContainerTag;
use Sphp\Html\AjaxLoaderInterface;

/**
 * Implements an HTML &lt;p&gt; tag
 *
 *  The {@link self} component represents a paragraph in an HTML document.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-06-03
 * @link    http://www.w3schools.com/tags/tag_p.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-p-element W3C HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Paragraph extends ContainerTag implements AjaxLoaderInterface {

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

}
