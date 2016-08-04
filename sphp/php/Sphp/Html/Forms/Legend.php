<?php

/**
 * Legend.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class models an HTML &lt;legend&gt; tag
 *
 * **Note:** The legend element represents a caption for the rest of the
 * contents of the legend element's parent fieldset element, if any.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-05-04
 * @link    http://www.w3schools.com/tags/tag_legend.asp w3schools HTML API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-legend-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Legend extends ContainerTag {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "legend";

  /**
   * Constructs a new instance
   *
   * @param string $content legend content
   */
  public function __construct($content = null) {
    parent::__construct(self::TAG_NAME, $content);
  }

}
