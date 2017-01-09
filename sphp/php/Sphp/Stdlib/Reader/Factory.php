<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Stdlib\Reader;

/**
 * Description of Factory
 *
 * @author Sami Holck
 */
class Factory {

  protected static $extensions = array(
      'php' => 'php',
      'ini' => 'ini',
      'json' => 'json',
      'yaml' => Yaml::class,
      'yml' => Yaml::class,
      'yml' => Yaml::class,
      'markdown' => MarkDown::class,
      'mdown' => MarkDown::class,
      'mkdn' => MarkDown::class,
      'md' => MarkDown::class,
      'mkd' => MarkDown::class,
      'mdwn' => MarkDown::class,
      'mdtxt' => MarkDown::class,
      'mdtext' => MarkDown::class,
      'text' => MarkDown::class,
      'Rmd' => MarkDown::class,
  );
  private static $instances = [];

  public static function fromFile($filepath) {
    $pathinfo = pathinfo($filepath);
    if (!isset($pathinfo['extension'])) {
      throw new Exception\RuntimeException(sprintf(
              'Filename "%s" is missing an extension and cannot be auto-detected', $filename
      ));
    }
  }

}
