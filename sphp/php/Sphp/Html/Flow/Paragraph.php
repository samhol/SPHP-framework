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
use Sphp\Html\AjaxLoader;

/**
 * Implements an HTML &lt;p&gt; tag
 *
 *  This component represents a paragraph in an HTML document.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_p.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-p-element W3C HTML API link
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Paragraph extends ContainerTag implements AjaxLoader {

  use \Sphp\Html\AjaxLoaderTrait;

  /**
   * Constructor
   *
   * @param  mixed $content optional content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('p', $content);
  }

  public function __invoke($content = null) {
    $this->resetContent($content);
    return $this;
  }
  
  public function appendMd(string $md) {
    $parsed = \ParsedownExtraPlugin::instance()->line($md);
    $this->append($parsed);
    return $this;
  }

}
