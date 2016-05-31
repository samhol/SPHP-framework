<?php

/**
 * HtmlTag.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Head\Head as Head;
use Sphp\Html\Programming\ScriptsContainer as ScriptsContainer;

/**
 * Class Models an HTML &lt;html&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-25
 * @link    http://www.w3schools.com/tags/tag_html.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Html extends AbstractComponent implements TraversableInterface {

  use TraversableTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "html";

  /**
   * Constructs a new instance of the {@link self] component
   *
   * **Common <var>$charset</var> values:**
   *
   * * UTF-8  - Character encoding for Unicode
   * * ISO-8859-1 - Character encoding for the Latin alphabet
   *
   * In theory, any character encoding can be used, but no browser understands
   * all of them. The more widely a character encoding is used, the better the
   * chance that a browser will understand it.
   *
   * @param string $title optional title of the document
   * @param string $charset optional character encoding of the document (defaults to: "UTF-8")
   * @param mixed|mixed[] $content optional body content
   */
  public function __construct($title = null, $charset = "UTF-8", $content = null) {
    parent::__construct(self::TAG_NAME);
    $this->content()
            ->set("head", new Head($title, $charset))
            ->set("body", new Body($content));
  }

  /**
   * Returns the head tag object
   *
   * @return Head the head tag object
   */
  public function head() {
    return $this->content()->get("head");
  }

  /**
   * Returns the body tag object
   *
   * @return Body the body tag object
   */
  public function body() {
    return $this->content()->get("body");
  }

  /**
   * Returns and optionally sets the inner script container
   * 
   * @param  ScriptsContainer|null $c optional new script container to set
   * @return ScriptsContainer the script container
   */
  public function scripts(ScriptsContainer $c = null) {
    return $this->body()->scripts($c);
  }

  /**
   * {@inheritdoc}
   */
  public function getOpeningTag() {
    return '<!DOCTYPE html>' . parent::getOpeningTag();
  }

  /**
   * 
   * @return string
   */
  public function getDocumentClose() {
    return $this->body()->close() . $this->getClosingTag();
  }

  /**
   * 
   * @return string
   */
  public function documentClose() {
    echo $this->getDocumentClose();
  }

  /**
   * Create a new iterator to iterate through inserted elements in the container
   *
   * @return \Iterator iterator
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * Counts the number of elements in the container
   *
   * @return int the number of elements in the container
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return $this->content()->count();
  }

}
