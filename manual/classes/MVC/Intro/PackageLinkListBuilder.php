<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC\Intro;

use Sphp\Html\Tags;

/**
 * Description of PackageLinkListBuilder
 *
 * @author samih
 */
class PackageLinkListBuilder {

  /**
   * @var LinkTextBuilder 
   */
  private $linkTextBuilder;

  /**
   *
   * @var type 
   */
  private $urlBuilder;

  public function __construct(callable $urlBuilder, LinkTextBuilder $linkTextBuilder = null) {
    if ($linkTextBuilder === null) {
      $linkTextBuilder = new LinkTextBuilder();
    }
    $this->linkTextBuilder = $linkTextBuilder;
    $this->urlBuilder = $urlBuilder;
  }

  public function linkTextBuilder(): LinkTextBuilder {
    return $this->linkTextBuilder;
  }

  public function builUrl($package) {
    $builder = $this->urlBuilder;
    return $builder($package);
  }

  public function build(iterable $packageData) {

    //$required = getComposerPackages();
    // $zends = Arrays::findKeysLike($required, 'zendframework');
    $ul = Tags::ul();
    $ul->addCssClass('packages');
    //$fa = new FontAwesome();
    //$fa->fixedWidth(true);
    foreach ($packageData as $component => $version) {
      $package = str_replace('zendframework/', '', $component);
      $ul->appendLink("https://github.com/$component", $this->linkTextBuilder()->build($package));
    }
    return $ul;
  }

  public static function github(): PackageLinkListBuilder {
    $instance = new static(new GithubUrlBuilder());
    $instance->linkTextBuilder()->setIcon('fab fa-github');
    return $instance;
  }

  public static function npm(): PackageLinkListBuilder {
    $instance = new static(new NpmUrlBuilder());
    $instance->linkTextBuilder()->setIcon('fab fa-npm');
    return $instance;
  }

}
