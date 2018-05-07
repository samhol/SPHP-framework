<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Class provides a simple implementation of a container tag
 *
 * AbstractComponent makes it possible to create new HTML components by composition
 * of other existing HTML components.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractContainerComponent extends AbstractComponent {

  /**
   * the inner content container
   *
   * @var ContainerInterface
   */
  private $content;

  /**
   * Constructor
   *
   * @param  string $tagname the name of the tag
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   */
  public function __construct(string $tagname, HtmlAttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagname, $attrManager);
    $this->setInnerContainer($contentContainer);
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  /**
   * Sets the inner content container of the component
   *
   * @param  ContainerInterface $contentContainer the inner content container of the component
   * @return $this for a fluent interface
   */
  protected function setInnerContainer(ContainerInterface $contentContainer = null) {
    if (!($contentContainer instanceof ContainerInterface)) {
      $this->content = new Container();
    } else {
      $this->content = $contentContainer;
    }
    return $this;
  }

  /**
   * Returns the content container or an element pointed by an optional index
   *
   * @return ContainerInterface the content container
   */
  protected function getInnerContainer(): ContainerInterface {
    return $this->content;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

}
