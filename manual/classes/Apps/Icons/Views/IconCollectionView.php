<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Foundation\Sites\Containers\CardReveal;
use Sphp\Manual;
use Sphp\Html\Apps\HyperlinkGenerators\Factory;
use Sphp\Html\Apps\HyperlinkGenerators\BasicPhpApiLinker;

/**
 * Implementation of IconCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconCollectionView {

  /**
   * @var BasicPhpApiLinker 
   */
  private $linker;
  private $data;

  public function __construct() {
    $this->linker = Factory::sami();
    $this->data = ParseFactory::fromFile('./manual/snippets/icons/DevIcons.json');
  }

  public function buildSingleIcon($name, $version) {
    $iconName = "$name-$version";
    $classLinker = $this->linker->classLinker(DevIcons::class);
    $method1 = $classLinker->methodLink('__invoke');
    $method1->resetContent("DevIcons::('$iconName')");
    $icon = DevIcons::i("$name-$version")->setTitle("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");

    $link = Tags::span($icon)->addCssClass('text-center icon');
    $link->setAttribute('data-open', 'dev-icons-font-version-info');
    $link->setAttribute('data-url', "/manual/snippets/icons/devicons/info.php?name=$name&version=$version&type=font");

    $content = Tags::div()->addCssClass('icon-container');
    $content->append($link);

    $ext = Tags::div($name)->addCssClass('ext', 'devicons');
    $content->append($ext);
    return $content;
  }

  public function getHtml(): string {

    $section = Tags::section();
    $section->addCssClass('icons', 'devicons');
    $section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
    $grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');
    $classLinker = $method1 = Manual\api()->classLinker(DevIcons::class);

    foreach ($this->data as $item) {
      $name = $item['name'];
      // echo "\n$name";
      foreach ($item['versions']['font'] as $version) {
        $card = new CardReveal();
        $card->addCssClass('icon-container', 'font');
        $iconName = "$name-$version";
        $method1 = $classLinker->methodLink('__invoke');
        $method1->resetContent("DevIcons::('$iconName')");
        $icon = DevIcons::i("$name-$version")->setTitle("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
        $card->getRevealTitle()->append($method1);
        $link = Tags::span($icon)->addCssClass('text-center icon');
        $link->setAttribute('data-open', 'dev-icons-font-version-info');
        $link->setAttribute('data-url', "/manual/snippets/icons/devicons/info.php?name=$name&version=$version&type=font");
        $card->getFront()->append($link);
        $content = Tags::div()->addCssClass('icon-container');
        $iconContainer = Tags::div()->addCssClass('icon', 'font', 'devicons');
        $content->append($iconContainer);
        $iconContainer->append($icon);

        $ext = Tags::div($name)->addCssClass('ext', 'devicons');
        $content->append($ext);
        $grid->append($card);
      }
    }

    $section->append($grid);
    echo $section;
  }

}
