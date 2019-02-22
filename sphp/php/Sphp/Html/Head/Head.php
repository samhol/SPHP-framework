<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\NonVisualContent;
use Sphp\Html\AbstractComponent;

/**
 * Implements an HTML &lt;head&gt; tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Head extends AbstractComponent implements \IteratorAggregate, NonVisualContent, \Sphp\Html\TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var HeadContentContainer
   */
  private $content;

  /**
   * Constructor
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   */
  public function __construct(string $title = null, string $charset = null) {
    parent::__construct('head');
    $this->content = new HeadContentContainer();
    if ($title !== null) {
      $this->setDocumentTitle($title);
    }
    if ($charset !== null) {
      $this->set(Meta::charset($charset));
    }
  }

  /**
   * Sets the title of the HTML page
   *
   * @param  string|Title $title the title of the HTML page
   * @return Title instance set
   */
  public function setDocumentTitle($title): Title {
    if (!$title instanceof Title) {
      $title = new Title($title);
    }
    $this->set($title);
    return $title;
  }

  /**
   * Sets a default URL and a default target for all links on a page
   *
   * @param  string $baseAddr the base URL for all relative URLs in the page
   * @param  string $target the default target for all hyperlinks and forms in the page
   * @return Base instance set
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function setBaseAddr(string $baseAddr, string $target = '_self'): Base {
    $base = new Base($baseAddr, $target);
    $this->content->set($base);
    return $base;
  }

  /**
   * Removes the default URL and a default target for all links on a page
   *
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/tag_base.asp  w3schools HTML API link
   */
  public function unsetBaseAddress() {
    $this->base = null;
    return $this;
  }

  /**
   * Adds content component to the object
   *
   * @param  HeadContent $component content the component to add
   * @return $this for a fluent interface
   */
  public function set(HeadContent $component) {
    $this->content->set($component);
    return $this;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function getIterator(): \Traversable {
    return $this->content;
  }

}
