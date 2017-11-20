<?php

/**
 * Document.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Document class contains basic Sphp HTML tag component creation and HTML version handing
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Document {

  /**
   * XHTML 1.0 version
   */
  const XHTML_1_0 = 'XHTML 1.0';

  /**
   * XHTML 1.1 version
   */
  const XHTML_1_1 = 'XHTML 1.1';

  /**
   * HTML5 version
   */
  const HTML5 = 'HTML5';

  /**
   * XHTML5 version
   */
  const XHTML5 = 'XHTML5';

  /**
   * current HTML version used
   *
   * @var string
   */
  private static $htmlVersion = self::HTML5;

  /**
   * Sets HTML version used in the application
   *
   * @param string $version
   */
  public static function setHtmlVersion($version) {
    self::$htmlVersion = $version;
  }

  /**
   * Returns the HTML version used in the application
   *
   * @return string HTML version used in the application
   */
  public static function getHtmlVersion() {
    return self::$htmlVersion;
  }

  /**
   * Checks if the current HTML version is a subtype of XHTML
   *
   * @return boolean true if the current HTML version used is a subtype of
   *         XHTML and false otherwise
   */
  public static function isXHTML() {
    return self::$htmlVersion == self::XHTML5 || self::$htmlVersion == self::XHTML_1_0 || self::$htmlVersion == self::XHTML_1_1;
  }

  /**
   * the HTML component
   *
   * @var Html[] 
   */
  private static $html = [];

  /**
   * Returns the HTML component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Html the HTML component pointed by the given name
   */
  public static function html($docName = 0): Html {
    if (!array_key_exists($docName, self::$html)) {
      self::$html[$docName] = new Html();
    }
    return self::$html[$docName];
  }

}
