<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\Intro;

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Tags;

/**
 * Description of PackageListBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PackageListBuilder {

  /**
   * @var FontAwesome
   */
  private $fa;
  private $linkTextBuilder;
  private $urlBuilder;

  public function __construct() {
    $this->fa = new FontAwesome();
    $this->fa->fixedWidth(true);
    $this->setLinkTextBuilder(new LinkTextBuilder());
    $this->setUrlBuilder(function(string $package): string {
      return "https://github.com/$package";
    });
  }

  public function buildLinkText($text) {
    $builder = $this->linkTextBuilder;
    return $builder($text);
  }

  public function builUrl($package) {
    $builder = $this->urlBuilder;
    return $builder($package);
  }

  public function setLinkTextBuilder($linkTextBuilder) {
    $this->linkTextBuilder = $linkTextBuilder;
    return $this;
  }
  public function getLinkTextBuilder():LinkTextBuilder {
  return  $this->linkTextBuilder;
  }

  public function setUrlBuilder($urlBuilder) {
    $this->urlBuilder = $urlBuilder;
    return $this;
  }

  public function build(iterable $packages) {
    $ul = Tags::ul()->addCssClass('packages');
    foreach ($packages as $component => $version) {
      $package = str_replace('zendframework/', '', $component);
      $ul->appendLink($this->builUrl($component), $this->buildLinkText($package));
    }
    return $ul;
  }

  public function buildLinkText1(string $icon, string $package): string {
    return Tags::span($this->fa->createIcon($icon))->addCssClass('icon') . Tags::span($package)->addCssClass('text');
  }

}
