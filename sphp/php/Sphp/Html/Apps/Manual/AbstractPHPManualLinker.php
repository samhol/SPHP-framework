<?php

/**
 * AbstractPHPManualLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Hyperlink as Hyperlink;
use Sphp\Core\Types\Strings as Strings;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPHPManualLinker extends AbstractPhpApiLinker {

  /**
   * Constructs a new instance
   *
   * @param string $attrs the default value of the target attribute
   *        for the generated links
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($attrs = ["target" => "php.net", "class" => ["external", "phpman", "api"]]) {
    parent::__construct("https://secure.php.net/manual/en/", $attrs);
  }
  /**
   * Returns a hyperlink object pointing to an PHP page
   * 
   * @param  string $relativeUrl optional path from the root to the resource
   * @param  string $content optional content of the link
   * @param  string $title optional title of the link
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   * @return Hyperlink hyperlink object pointing to an PHP page
   */
  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    if (Strings::isEmpty($title)) {
      $title = "PHP manual";
    } else {
      $title = "PHP manual: " . $title;
    }
    return parent::hyperlink($relativeUrl, $content, $title);
  }

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return self for PHP Method Chaining
   */
  public function setLanguage($lang) {
    $url = preg_replace('~[a-z]{2}\/$~', "$lang/", $this->getApiRoot());
    $this->setApiRoot($url);
    return $this;
  }

  /**
   * Fixes the relative path to the PHP documentation resource
   * 
   * @param  string $path the relative path to the PHP documentation resource
   * @return string the fixed relative path to the PHP documentation resource
   */
  protected function phpPathFixer($path) {
    return strtolower(str_replace(['_', '\\'], ['-', '.'], $path));
  }

}
