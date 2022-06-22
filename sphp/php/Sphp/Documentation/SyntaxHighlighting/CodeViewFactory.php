<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting;

use Sphp\Bootstrap\Components\Modal;
use Sphp\Bootstrap\Components\Accordions\Accordion;
use Sphp\Documentation\SyntaxHighlighting\Bootstrap\AccordionBuilder;
use SplFileObject;

/**
 * The ViewerFactory class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CodeViewFactory {

  /**
   * 
   * @param  mixed $trigger
   * @param  string $path
   * @param  mixed $title
   * @return Modal
   */
  public function createModal(string $path): Modal {
    $modal = new Modal();
    $modal->setFullScreen('lg-down')->setSize('xl');
    $prism = new Prism();
    $modal->getBody()->append($prism->blockFromFile($path));
    $modal->getHeader()->append("{$this->getLanguageNameFromFile($path)} language");
    return $modal;
  }

  private static array $langMap = [
      'php' => 'PHP',
      'php4' => 'PHP',
      'phtml' => 'PHP',
      'html' => 'HTML',
      'js' => 'JavaScript',
      'cjs' => 'JavaScript',
      'mjs' => 'JavaScript',
      'mjs' => 'JavaScript',
      'sql' => 'SQL',
  ];

  public function getLanguageNameFromFile(string $path): ?string {
    $lang = null;
    $file = new SplFileObject($path);
    $ext = $file->getExtension();
    if (array_key_exists($ext, self::$langMap)) {
      $lang = self::$langMap[$ext];
    }
    return $lang;
  }

  public function createCodeBlock(string $path) {
    $prism = new Prism();
    return $prism->blockFromFile($path);
  }

  public function createCodeAccordion(array $setup): Accordion {
    $accordionBuilder = new AccordionBuilder();
    $accordion = new Accordion();
    foreach ($setup as $paneSetup) {
      $path = $paneSetup['path'];
      $title = $paneSetup['title'] ?? "{$this->getLanguageNameFromFile($path)} language";
      $accordion->appendPane($title, $this->createCodeBlock($path));
    }
    return $accordion;
  }

}
