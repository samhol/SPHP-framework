<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Text;

use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML span tag
 *
 * The &lt;span&gt; tag is used to group inline-elements in a document. It
 * provides no visual change by itself. The &lt;span&gt; tag provides a
 * way to add a hook to a part of a text or a part of a document. When a text
 * is hooked in a &lt;span&gt; element, you can style it with CSS, or
 * manipulate it with JavaScript.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_span.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Span extends ContainerTag {

  /**
   * Constructor
   *
   * @param  mixed $content optional content of the component
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(mixed $content = null) {
    parent::__construct('span', $content);
  }

}
