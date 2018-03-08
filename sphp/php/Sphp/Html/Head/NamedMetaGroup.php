<?php

/**
 * MetaGroup.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\Content;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Html\TraversableContent;
use Sphp\Html\NonVisualContent;

/**
 * Container for metadata components
 *
 *  The &lt;meta&gt; tag provides meta data about the HTML document. Metadata will not be displayed on the page,
 *  but will be machine parable. Meta elements are typically used to specify page description, keywords, author
 *  of the document, last modified, and other metadata. The metadata can be used by browsers (how to display
 *  content or reload page), search engines (keywords), or other web services.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NamedMetaGroup extends MetaGroup {

  /**
   * Creates a named content meta data object
   *
   * **Notes:**
   * 
   * * The name attribute specifies the name for the metadata.
   * * The name attribute specifies a name for the information/value of the content attribute.
   * * **Note:** If the http-equiv attribute is set, the name attribute should not be set.
   * 
   * @param  string $name specifies a name for the metadata
   * @param  string $content the value of the content attribute
   * @return Meta created meta data object
   * @link   http://www.w3schools.com/tags/att_meta_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_meta_content.asp content attribute
   */
  public function setNamedContent(string $name, string $content): Meta {
    $meta = new Meta(['name' => $name, 'content' => $content]);
    $this->set($meta);
    return $meta;
  }

  /**
   * Adds a meta data object to the container
   *
   * @param  MetaData $content meta information to add
   * @return $this for a fluent interface
   */
  public function set(MetaData $content) {
    if (!$content->hasNamedContent()) {
      throw new InvalidArgumentException();
    }
    parent::set($content);
    return $this;
  }

}
