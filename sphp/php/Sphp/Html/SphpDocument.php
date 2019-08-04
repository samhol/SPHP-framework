<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Head\Head;
use Sphp\Html\Scripts\ScriptSrc;
use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

/**
 * Implements an HTML &lt;html&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_html.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SphpDocument extends AbstractContent {

  /**
   * @var Html 
   */
  private $html;

  /**
   * Constructor
   * 
   * @param Html $html
   */
  public function __construct(Html $html = null) {
    if ($html === null) {
      $html = new Html();
    }
    $this->html = $html;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->html);
  }

  public function __clone() {
    $this->html = clone $this->html;
  }

  /**
   * Returns the &lt;html&gt;  component 
   *
   * @return Html the html tag object
   */
  public function html(): Html {
    return $this->html;
  }

  /**
   * Returns the &lt;head&gt;  component 
   *
   * @return Head the head tag object
   */
  public function head(): Head {
    return $this->html()->head();
  }

  /**
   * Returns the &lt;body&gt;  component 
   *
   * @return Body the body component
   */
  public function body(): Body {
    return $this->html()->body();
  }

  /**
   * Sets the title of the html page
   *
   * @param  string|Title $title the title of the html page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle($title) {
    $this->head()->setDocumentTitle($title);
    return $this;
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
    $this->html()->attributes()->setAttribute('lang', $language);
    return $this;
  }

  /**
   * 
   * @param  string $viewport
   * @return $this for a fluent interface
   */
  public function setViewport(string $viewport = 'width=device-width, initial-scale=1.0') {
    $this->head()->set(Meta::viewport($viewport));
    return $this;
  }

  /**
   * Sets up the Font Awesome icons
   *
   * @return $this for a fluent interface
   * @link   http://fontawesome.io/icons/?utm_source=www.qipaotu.com Font Awesome icons
   */
  public function useFontAwesome(string $id = null) {
    $this->head()->set((new ScriptSrc("https://kit.fontawesome.com/$id.js"))
                    ->setDefer(true));
    return $this;
  }

  /**
   * Sets the required CSS and JavaScript files for Video.js
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function useVideoJS() {
    $this->head()->set(Link::stylesheet('https://vjs.zencdn.net/7.3.0/video-js.css'));
    $this->body()->scripts()->appendSrc('https://vjs.zencdn.net/7.3.0/video.js');
    return $this;
  }

  /**
   * Sets up the SPHP framework related JavaScript files to the end of the body
   *
   * @return $this for a fluent interface
   */
  public function enableSPHP() {
    $this->body()->scripts()->appendSrc('/sphp/javascript/dist/all.js');
    return $this;
  }

  public function getHtml(): string {
    return $this->html()->getHtml();
  }

  /**
   * 
   * @return string
   */
  public function getBodyStart(): string {
    $output = $this->html()->getOpeningTag();
    $output .= $this->head()->getHtml();
    $output .= $this->body()->getOpeningTag();
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
  public static function create(string $title = null, string $charset = null, string $lang = null) {
    $html = new Html($title, $charset, $lang);
    return new static($html);
  }

}
