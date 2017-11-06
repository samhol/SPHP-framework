<?php

/**
 * Html.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Html\Head\Head;
use Sphp\Html\Programming\ScriptsContainer;

/**
 * Implements an HTML &lt;html&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_html.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Html extends AbstractComponent implements IteratorAggregate, TraversableInterface, ContentParserInterface {

  use TraversableTrait;

  /**
   * @var Head 
   */
  private $head;

  /**
   * @var Body 
   */
  private $body;

  /**
   * Constructs a new instance
   *
   * **Common `$charset` values:**
   *
   * * `UTF-8`  - Character encoding for Unicode
   * * `ISO-8859-1` - Character encoding for the Latin alphabet
   *
   * In theory, any character encoding can be used, but no browser understands
   * all of them. The more widely a character encoding is used, the better the
   * chance that a browser will understand it.
   *
   * @param string|null $title optional title of the document
   * @param string|null $charset optional character encoding of the document (defaults to: "UTF-8")
   * @param string|null $lang optional body content
   */
  public function __construct(string $title = null, string $charset = 'UTF-8', string $lang = null) {
    parent::__construct('html');
    $this->head = new Head($title, $charset);
    $this->body = new Body();
    if ($lang !== null) {
      $this->setLanguage($lang);
    }
  }

  public function __destruct() {
    unset($this->head, $this->body);
    parent::__destruct();
  }

  public function __clone() {
    $this->head = clone $this->head;
    $this->body = clone $this->body;
    parent::__clone();
  }

  /**
   * Returns the &lt;head&gt;  component 
   *
   * @return Head the head tag object
   */
  public function head() {
    return $this->head;
  }

  /**
   * Returns the &lt;body&gt;  component 
   *
   * @return Body the body component
   */
  public function body() {
    return $this->body;
  }

  /**
   * Sets the language of the document 
   * 
   * **NOTE:** Sets the value of the `lang` attribute
   *
   * Specifies the MIME type of the script
   *
   * @param  string $language the language of the document 
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_lang.asp lang attribute
   */
  public function setLanguage(string $language) {
    $this->attrs()->set('lang', $language);
    return $this;
  }

  /**
   * Sets the title of the html page
   *
   * @param  string|Title $title the title of the html page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle($title) {
    $this->head->setDocumentTitle($title);
    return $this;
  }

  /**
   * Sets up the SPHP framework related JavaScript and CSS files
   *
   * @return $this for a fluent interface
   */
  public function enableSPHP() {
    $this->head->enableSPHP();
    $this->body->enableSPHP();
    return $this;
  }

  /**
   * Returns and optionally sets the inner script container
   * 
   * @param  ScriptsContainer|null $c optional new script container to set
   * @return ScriptsContainer the script container
   */
  public function scripts(ScriptsContainer $c = null) {
    return $this->body->scripts($c);
  }

  /**
   * 
   * @return string
   */
  public function getOpeningTag(): string {
    return '<!DOCTYPE html>' . parent::getOpeningTag();
  }

  /**
   * 
   * @return string
   */
  public function getBodyStart(): string {
    $output = $this->getOpeningTag();
    $output .= $this->head->getHtml();
    $output .= $this->body->getOpeningTag();
    return $output;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function startBody() {
    echo $this->getBodyStart();
    return $this;
  }

  /**
   * 
   * @return string 
   */
  public function getDocumentClose(): string {
    return $this->body()->close() . $this->getClosingTag();
  }

  /**
   * 
   * 
   * @return $this for a fluent interface
   */
  public function documentClose() {
    echo $this->getDocumentClose();
    return $this;
  }

  public function getIterator() {
    return $this->body->getIterator();
  }

  public function count(): int {
    return $this->body->count();
  }

  public function contentToString(): string {
    return $this->head . $this->body;
  }

  public function append($content) {
    $this->body->append($content);
    return $this;
  }

  public function appendMd(string $md) {
    $this->body->appendMd($md);
    return $this;
  }

  public function appendMdFile(string $path) {
    $this->body->appendMdFile($path);
    return $this;
  }

  public function appendPhpFile(string $path) {
    $this->body->appendPhpFile($path);
    return $this;
  }

  public function appendRawFile(string $path) {
    $this->body->appendRawFile($path);
    return $this;
  }

}

