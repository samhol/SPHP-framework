<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Container;
use Sphp\Html\PlainContainer;

/**
 * Implements a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlSlide extends AbstractSlide {

  /**
   * @var PlainContainer 
   */
  private $htmlContent;

  /**
   * Constructor
   *
   * @param  mixed $content the content of the slide
   */
  public function __construct($content = null) {
    parent::__construct();
    $this->htmlContent = new PlainContainer();
    if ($content !== null) {
      $this->append($content);
    }
  }

  public function getHtmlContent(): Container {
    return $this->htmlContent;
  }

  public function setHtmlContent(PlainContainer $htmlContent) {
    $this->htmlContent = $htmlContent;
    return $this;
  }

  public function contentToString(): string {
    return $this->htmlContent->getHtml();
  }

}
