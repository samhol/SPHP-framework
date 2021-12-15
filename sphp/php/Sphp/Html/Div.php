<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Sections\AbstractFlowContainer;

/**
 * Implementation of an HTML div tag
 *
 * This component defines a division or a section in an HTML document. 
 * It is used to group block-elements to format them with CSS to layout a web page.
 * 
 * By default, browsers always place a line break before and after the &lt;div&gt; element.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_div.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Div extends AbstractFlowContainer {

  /**
   * Constructor
   *
   * @param mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('div', $content);
  }

  public function __call(string $name, array $arguments): Tag {
    $tag = strtolower(str_replace('append', '', $name));
    $this->append($content = Tags::create($tag, ...$arguments));
    return $content;
  }

}
