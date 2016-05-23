<?php

/**
 * Body.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Programming\ScriptsContainer as ScriptsContainer;

/**
 * Class models an HTML &lt;body&gt; tag
 *
 * The {@link self] component represents the main content of the HTML document.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-25
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_body.asp w3schools API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Body extends ContainerTag {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "body";
  
  /**
   *
   * @var ScriptsContainer 
   */
  private $scripts;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can basically be of any type that converts
   * to a string. So also an object of any class that implements magic method 
   * `__toString()` is allowed.
   *
   * @param  mixed $content the content of the component
   */
  public function __construct($content = null) {
    parent::__construct(self::TAG_NAME, $content);
    $this->scripts = new ScriptsContainer();
  }
  
  /**
   */
  public function close() {
    return $this->scripts . $this->getClosingTag();
  }
  
  /**
   * Returns and optionally sets the inner script container
   * 
   * @param  ScriptsContainer|null $c optional new script container to set
   * @return ScriptsContainer the script container
   */
  public function scripts(ScriptsContainer $c = null) {
    if ($c !== null) {
      $this->scripts = $c;
    }
    return $this->scripts;
  }

}
