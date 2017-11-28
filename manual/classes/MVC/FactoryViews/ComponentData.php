<?php

/**
 * TagGroupAccordionGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\FactoryViews;

use Sphp\Html\TagFactory;
use Sphp\Html\TagInterface;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Description of TagComponentDataParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ComponentData extends Arrayable {

  public function getCall();

  public function getDocumentCall(): string;

  public function getComponent(): \Sphp\Html\TagInterface;

  public function getDescription(): string;

  public function getTagName(): string;

  public function getObjectType(): string;

  public function getCallLink(): string;

  public function getW3schoolsLink(): string;
}
