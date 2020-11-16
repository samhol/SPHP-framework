<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements a hyperlink container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HyperlinkContainer extends AbstractContainerTag implements Hyperlink {

  /**
   * Constructor
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $tagName the tag name of the component
   * @param  A|null $hyperlink the inner hyperlink object or null
   */
  public function __construct(string $tagName, A $hyperlink = null) {
    if ($hyperlink === null) {
      $hyperlink = new A();
    }
    parent::__construct($tagName, null, $hyperlink);
  }

  /**
   * Returns the actual hyperlink component in the menu item component
   * 
   * @return A the actual hyperlink component in the menu item component
   */
  public function getHyperlink(): A {
    return $this->getInnerContainer();
  }

  public function getHref(): ?string {
    return $this->getHyperlink()->getHref();
  }

  public function setHref(string $href = null) {
    $this->getHyperlink()->setHref($href);
    return $this;
  }

  public function setTarget(string $target = null) {
    $this->getHyperlink()->setTarget($target);
    return $this;
  }

  public function getTarget(): ?string {
    return $this->getHyperlink()->getTarget();
  }

  public function setRelationship(string $rel = null) {
    $this->getHyperlink()->setRelationship($rel);
    return $this;
  }

  public function getRelationship(): ?string {
    return $this->getHyperlink()->getRelationship();
  }

}
