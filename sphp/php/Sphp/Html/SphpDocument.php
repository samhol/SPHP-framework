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

use Sphp\Html\Head\Head;
use Sphp\Html\Scripts\ExternalScript;
use Sphp\Html\Head\MetaFactory;

/**
 * Implementation of an HTML html tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_html.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SphpDocument extends AbstractContent {
 
  private Html $html;

  /**
   * Constructor
   * 
   * @param Html|null $html
   */
  public function __construct(?Html $html = null) {
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
   * @param  string $title the title of the html page
   * @return $this for a fluent interface
   */
  public function setDocumentTitle(string $title) {
    $this->head()->meta()->setTitle($title);
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
   * @link   https://www.w3schools.com/tags/att_lang.asp lang attribute
   */
  public function setLanguage(string $language = null) {
    $this->html()->setAttribute('lang', $language);
    return $this;
  }

  /**
   * Sets up the Font Awesome icons
   *
   * @return $this for a fluent interface
   * @link   http://fontawesome.io/icons/?utm_source=www.qipaotu.com Font Awesome icons
   */
  public function useFontAwesome(string $id = null) {
    $this->head()->meta()->insert((new ExternalScript("https://kit.fontawesome.com/$id.js"))
                    ->setIntegrity(null, 'anonymous')->setDefer(true));
    return $this;
  }

  /**
   * Sets the required CSS and JavaScript files for Video.js
   *
   * @return $this for a fluent interface
   * @link   http://www.videojs.com/ Video.js
   */
  public function useVideoJS() {
    $this->head()->meta()->insert(MetaFactory::build()->stylesheet('https://vjs.zencdn.net/7.8.4/video-js.css'));
    $this->body()->scripts()->insertExternal('https://vjs.zencdn.net/7.8.4/video.js');
    return $this;
  }

  /**
   * Sets up the SPHP framework related JavaScript files to the end of the body
   *
   * @return $this for a fluent interface
   */
  public function enableSPHP() {
    $this->body()->scripts()->insertExternal('/sphp/javascript/dist/all.js', 1000)->setDefer(true);
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
    return $this->html()->getBodyStart();
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
    return $this->html()->getDocumentClose();
  }

  /**
   * Prints the component as HTML markup string
   * 
   * @return $this for a fluent interface
   */
  public function documentClose() {
    echo $this->html()->getDocumentClose();
    return $this;
  }

}
