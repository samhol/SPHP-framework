<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Scripts\ScriptsContainer;

/**
 * Implements an HTML &lt;body&gt; tag
 *
 * This component represents the main content of the HTML document.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_body.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Body extends ContainerTag implements ContentParser {

  use ContentParserTrait;

  /**
   * @var ScriptsContainer 
   */
  private $scripts;

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can basically be of any type that converts
   * to a string. So also an object of any class that implements magic method 
   * `__toString()` is allowed.
   *
   * @param  mixed $content the content of the component
   */
  public function __construct($content = null) {
    parent::__construct('body', $content);
    $this->scripts = new ScriptsContainer();
  }

  public function __destruct() {
    unset($this->scripts);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->scripts = clone $this->scripts;
  }

  public function contentToString(): string {
    return parent::contentToString() . $this->scripts();
  }

  /**
   * Returns parsed script tags and the closing tag
   * 
   * @return string the script tags and the closing tag
   */
  public function close(): string {
    return $this->scripts . $this->getClosingTag();
  }

  /**
   * Returns and optionally sets the inner script container
   * 
   * @param  ScriptsContainer|null $c optional new script container to set
   * @return ScriptsContainer the script container
   */
  public function scripts(ScriptsContainer $c = null): ScriptsContainer {
    if ($c !== null) {
      $this->scripts = $c;
    }
    return $this->scripts;
  }

}
