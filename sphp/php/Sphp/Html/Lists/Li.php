<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;
use Sphp\Html\Tags;
use Sphp\Html\Tag;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements an HTML-list element &lt;li tag
 *
 * @method  \Sphp\Html\Text\Span appendSpan(mixed $content = null) creates a new span tag component
 * @method  \Sphp\Html\Text\Strong appendStrong(mixed $content = null) creates a new strong tag component
 * @method  \Sphp\Html\Text\Span appendVar(mixed $content = null) creates a new var tag component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_li.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Li extends ContainerTag implements StandardListItem {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * PHP string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   *
   * @param  null|mixed|mixed[] $content optional content of the component
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('li', $content);
  }

}
