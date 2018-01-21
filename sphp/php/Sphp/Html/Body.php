<?php

/**
 * Body.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Programming\ScriptsContainer;
use Sphp\Html\Programming\SphpScriptsLoader;

/**
 * Implements an HTML &lt;body&gt; tag
 *
 * This component represents the main content of the HTML document.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_body.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Body extends ContainerTag implements ContentParser {

  use ContentParsingTrait;

  /**
   * @var ScriptsContainer 
   */
  private $scripts;

  /**
   * Constructs a new instance
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
  public function close() {
    return $this->scripts . $this->getClosingTag();
  }

  /**
   * Sets up the SPHP framework related JavaScript files to the end of the body
   *
   * @return $this for a fluent interface
   */
  public function enableSPHP() {
    $sphpScripts = new SphpScriptsLoader();
    $sphpScripts->appendSPHP();
    $this->scripts($sphpScripts);
    return $this;
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
