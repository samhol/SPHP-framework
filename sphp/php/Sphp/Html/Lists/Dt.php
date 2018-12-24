<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;dt&gt; tag
 *
 * This component defines an term in an HTML definition list. It is used in 
 * conjunction with its definitions {@link Dd}
 * 
 * This component can contain HTML with paragraphs, line breaks, 
 * images, links, lists, etc and/or components implementing these HTML 
 * elements.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_dt.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dt extends ContainerTag implements DlContent {

  /**
   * Constructor
   * 
   * @param  null|mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('dt', $content);
  }

}
