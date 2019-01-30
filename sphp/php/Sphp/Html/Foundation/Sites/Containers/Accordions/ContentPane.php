<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Html\AjaxLoader;
use Sphp\Html\ContentParser;
use Sphp\Html\Lists\StandardListItem;

/**
 * Implements a Pane for a Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContentPane extends AbstractPane implements AjaxLoader, ContentParser, StandardListItem {

  use \Sphp\Html\ContentParserTrait;

  /**
   * Appends new content as the last element
   *
   * @param  mixed,... $content new content
   * @return $this for a fluent interface
   */
  public function append(...$content) {
    $this->getContent()->append($content);
    return $this;
  }

  public function ajaxAppend(string $url) {
    $this->getContent()->ajaxAppend($url);
    return $this;
  }

  public function ajaxPrepend(string $url) {
    $this->getContent()->ajaxPrepend($url);
    return $this;
  }

}
