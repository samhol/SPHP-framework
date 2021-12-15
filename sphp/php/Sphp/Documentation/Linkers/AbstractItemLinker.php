<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;

use Sphp\Html\Navigation\A;
use Sphp\Html\AbstractContent;

/**
 * Abstract implementation of itemlinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractItemLinker extends AbstractContent implements ItemLinker {

  private HyperlinkFactory $hyperlinkFactory;

  /**
   * Constructor
   *
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(?HyperlinkFactory $hyperlinkFactory = null) {
    if ($hyperlinkFactory === null) {
      $hyperlinkFactory = new HyperlinkFactory();
    }
    $this->setHyperlinkFactory($hyperlinkFactory);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->hyperlinkFactory);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->hyperlinkFactory = clone $this->hyperlinkFactory;
  }

  /**
   * Returns a clone of the current hyperlink factory
   * 
   * @return HyperlinkFactory new cloned instance
   */
  public function cloneHyperlinkFactory(): HyperlinkFactory {
    return clone $this->hyperlinkFactory;
  }

  /**
   * Returns current hyperlink factory
   * 
   * @return HyperlinkFactory current hyperlink factory
   */
  public function getHyperlinkFactory(): HyperlinkFactory {
    return $this->hyperlinkFactory;
  }

  /**
   * Sets the current hyperlink factory
   * 
   * @param  HyperlinkFactory $hyperlinkFactory new instance
   * @return $this for a fluent interface
   */
  public function setHyperlinkFactory(HyperlinkFactory $hyperlinkFactory) {
    $this->hyperlinkFactory = $hyperlinkFactory;
    return $this;
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the given HTML tag
   * 
   * @param  string $linkText optional link content
   * @return A hyperlink object pointing to the API documentation of the given HTML tag
   */
  public function toHyperlink(string $linkText = null): A {
    if ($linkText === null) {
      $linkText = $this->getDefaultContent();
    }
    return $this->getHyperlinkFactory()->buildHyperlink($this->getUrl(), $linkText, $this->getDefaultTitle());
  }

  public function getHtml(): string {
    return (string) $this->toHyperlink();
  }

}
