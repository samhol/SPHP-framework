<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Bootstrap\Components\Forms\InputGroup;
use Sphp\Html\Forms\Buttons\ButtonInterface;

/**
 * The ToolBar class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ToolBar extends AbstractComponent {

  /**
   * @var PlainContainer
   */
  private $groups;

  public function __construct(string $ariaLabel = null) {
    parent::__construct('div');
    $this->setAttribute('aria-label', $ariaLabel);
    $this->cssClasses()->protectValue('btn-toolbar');
    $this->attributes()->protect('role', 'toolbar');
    $this->groups = new PlainContainer();
  }

  /**
   * Creates and appends a new hyperlink to the toolbar
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the implemented &lt;a&gt; tag is not a hyperlink in HTML5.
   * * If the $content is empty, the $href is also the content of the object.
   * 
   * @param  string|null $href the URL of the link
   * @param  string|null $content the content of the button
   * @param  string|null $target the value of the target attribute
   * @return A created instance
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(string $href, $content, string $target = null): ButtonGroup {
    $group = new ButtonGroup();
    $group->appendHyperlink($href, $content, $target);
    $this->addGroup($group);
    return $group;
  }

  public function appendInput(Input $input): InputGroup {
    $group = new InputGroup($input);
    $this->appendInputGroup($group);
    return $group;
  }

  public function appendInputGroup(InputGroup $group) {
    $this->groups->append($group);
    return $this;
  }

  public function addGroup(ButtonGroup $group) {
    $this->groups->append($group);
    return $this;
  }

  public function appendGroupFrom(...$button): ButtonGroup {
    $group = new ButtonGroup();
    $group->append($button);
    $this->addGroup($group);
    return $group;
  }

  public function contentToString(): string {
    return $this->groups->getHtml();
  }

  public function appendButton(ButtonInterface $button): ButtonGroup {
    $group = new ButtonGroup();
    $group->appendButton($button);
    $this->addGroup($group);
    return $group;
  }

  public function append($content): ButtonGroup {
    $group = new ButtonGroup();
    $group->append($content);
    $this->groups->append($group);
    return $group;
  }

}
