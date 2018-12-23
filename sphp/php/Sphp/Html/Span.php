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
 * Implements an HTML &lt;span&gt; tag
 *
 * The &lt;span&gt; tag is used to group inline-elements in a document. It
 * provides no visual change by itself. The &lt;span&gt; tag provides a
 * way to add a hook to a part of a text or a part of a document. When a text
 * is hooked in a &lt;span&gt; element, you can style it with CSS, or
 * manipulate it with JavaScript.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_span.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Span extends ContainerTag implements InlineContainer {

  /**
   * Constructor
   *
   * @param null|mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('span', $content);
  }

}
