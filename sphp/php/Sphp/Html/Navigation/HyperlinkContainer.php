<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\ContentIterator;

/**
 * Implements a hyperlink container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HyperlinkContainer extends AbstractComponent implements \IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  private Hyperlink $hyperlink;

  /**
   * Constructor
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $tagName the tag name of the component
   * @param  Hyperlink|null $hyperlink the inner hyperlink object or null
   */
  public function __construct(string $tagName, ?Hyperlink $hyperlink = null) {
    if ($hyperlink === null) {
      $hyperlink = new A();
    }
    $this->hyperlink = $hyperlink;
    parent::__construct($tagName);
  }

  /**
   * Returns the actual hyperlink component in the menu item component
   * 
   * @return Hyperlink the actual hyperlink component in the menu item component
   */
  public function getHyperlink(): Hyperlink {
    return $this->hyperlink;
  }

  public function contentToString(): string {
    return $this->hyperlink->getHtml();
  }

  public function getIterator(): \Traversable {
    return new ContentIterator($this->hyperlink);
  }

}
