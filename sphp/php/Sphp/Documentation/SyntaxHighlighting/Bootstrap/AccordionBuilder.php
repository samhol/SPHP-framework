<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting\Bootstrap;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Accordions\Accordion;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Documentation\SyntaxHighlighting\Prism;

/**
 * Class AccordionBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AccordionBuilder extends AbstractContent {

  private array $setup;

  public function __construct() {
    $this->setup = [];
  }

  public function appendFilePane(string $path, ?string $title = null) {
    $file = new \SplFileInfo($path);
    if (!$file->isReadable()) {
      throw new InvalidArgumentException();
    }
    if ($title === null) {
      $title = $file->getFilename();
    }
    $this->setup[] = ['path' => $path, 'title' => $title];
    return $this;
  }

  public function setup(array $setup) {
    $this->setup = [];
    foreach ($setup as $key => $value) {
      $this->appendFilePane(...$value);
    }
    return $this;
  }

  public function createCodeBlock(string $path) {
    $prism = new Prism();
    return $prism->blockFromFile($path);
  }

  public function createCodeAccordion(): Accordion {
    $accordion = new Accordion();
    foreach ($this->setup as $paneSetup) {
      $path = $paneSetup['path'];
      $title = $paneSetup['title'];
      //$title = $paneSetup['title'] ?? "{$this->getLanguageNameFromFile($path)} language";
      $accordion->appendPane($title, $this->createCodeBlock($path));
    }
    return $accordion;
  }

  public function getHtml(): string {
    return $this->createCodeAccordion()->getHtml();
  }

}
