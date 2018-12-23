<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

/**
 * Implements an HTML &lt;div&gt; tag
 *
 * This component defines a division or a section in an HTML document. 
 * It is used to group block-elements to format them with CSS to layout a web page.
 * 
 * By default, browsers always place a line break before and after the &lt;div&gt; element.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_div.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Div extends ContainerTag implements AjaxLoader {

  use AjaxLoaderTrait;

  /**
   * Constructor
   *
   * @param mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('div', $content);
  }

}
