<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use IteratorAggregate;
use Sphp\Html\Head\Head;
use Sphp\Html\Scripts\ScriptsContainer;
use Sphp\Html\Scripts\ScriptSrc;
use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;
use Traversable;

/**
 * Implements an HTML &lt;html&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_html.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Html extends AbstractComponent implements IteratorAggregate, TraversableContent {

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
   * Constructor
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
  public function __construct(string $title = null, string $charset = null, string $lang = null) {
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
  public function head(): Head {
    return $this->head;
  }

  /**
   * Returns the &lt;body&gt;  component 
   *
   * @return Body the body component
   */
  public function body(): Body {
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
  public function setLanguage(string $language = null) {
    $this->attributes()->setAttribute('lang', $language);
    return $this;
  }

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
   * Returns the document end
   * 
   * @return string the document end
   */
  public function getDocumentClose(): string {
    return $this->body()->close() . $this->getClosingTag();
  }

  /**
   * Prints the component as HTML markup string
   * 
   * @return $this for a fluent interface
   */
  public function documentClose() {
    echo $this->getDocumentClose();
    return $this;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $it = new Iterator([$this->head(), $this->body()]);
    return $it;
  }

  public function contentToString(): string {
    return $this->head() . $this->body();
  }

}
