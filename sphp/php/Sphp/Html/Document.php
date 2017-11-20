<?php

/**
 * Document.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Head\Head;

/**
 * Document class contains basic Sphp HTML tag component creation and HTML version handing
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Document {

  /**
   * the HTML component
   *
   * @var Html[] 
   */
  private static $html = [];

  /**
   * Returns the HTML component pointed by the given name
   * 
   * @param  string|null $docName the name of the managed document
   * @return Html the `html` component pointed by the given name
   */
  public static function create(string $docName = null, Html $template = null): Html {
    if (!isset(static::$html[$docName])) {
      if ($template === null) {
        $template = new Html();
      }
      static::$html[$docName] = $template;
    }
    return static::$html[$docName];
  }

  /**
   * Returns the root `html` component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Html the `html` component pointed by the given name
   */
  public static function html(string $docName = null): Html {
    if (!isset(static::$html[$docName])) {
      static::create($docName);
    }
    return self::$html[$docName];
  }

  /**
   * Returns the HTML `body` component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Body the `body` component pointed by the given name
   */
  public static function body(string $docName = null): Body {
    if (!isset(static::$html[$docName])) {
      throw new InvalidArgumentException("Document $docName is not stored");
    }
    return static::html($docName)->body();
  }

  /**
   * Returns the HTML `head` component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Head the `head` component pointed by the given name
   */
  public static function head(string $docName = null): Head {
    if (!isset(static::$html[$docName])) {
      throw new InvalidArgumentException("Document $docName is not stored");
    }
    return static::html($docName)->head();
  }

}
