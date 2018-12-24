<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */
namespace Sphp\Html\Flow;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;aside&gt; tag
 *
 *  This component defines sections in a document, such as chapters, headers, 
 *  footers, or any other sections of the document.
 * 
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_aside.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Aside extends ContainerTag {

  /**
   * Constructor
   * 
   * @param  mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('aside', $content);
  }

}
