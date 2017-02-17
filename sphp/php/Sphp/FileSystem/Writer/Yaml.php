<?php

/**
 * Yaml.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filesystem\Writer;

use InvalidArgumentException;
use RuntimeException;

class Yaml extends AbstractWriter {

  /**
   * YAML encoder callback
   *
   * @var callable
   */
  protected $yamlEncoder;

  /**
   * Constructor
   *
   * @param callable|string|null $yamlEncoder
   */
  public function __construct($yamlEncoder = null) {
    if ($yamlEncoder !== null) {
      $this->setYamlEncoder($yamlEncoder);
    } else {
      if (function_exists('yaml_emit')) {
        $this->setYamlEncoder('yaml_emit');
      }
    }
  }

  /**
   * Get callback for decoding YAML
   *
   * @return callable
   */
  public function getYamlEncoder() {
    return $this->yamlEncoder;
  }

  /**
   * Set callback for decoding YAML
   *
   * @param  callable $yamlEncoder the decoder to set
   * @return Yaml
   * @throws InvalidArgumentException
   */
  public function setYamlEncoder($yamlEncoder) {
    if (!is_callable($yamlEncoder)) {
      throw new InvalidArgumentException('Invalid parameter to setYamlEncoder() - must be callable');
    }
    $this->yamlEncoder = $yamlEncoder;
    return $this;
  }

  /**
   * processConfig(): defined by AbstractWriter.
   *
   * @param  array $config
   * @return string
   * @throws RuntimeException
   */
  public function processConfig(array $config) {
    if (null === $this->getYamlEncoder()) {
      throw new RuntimeException("You didn't specify a Yaml callback encoder");
    }

    $config = call_user_func($this->getYamlEncoder(), $config);
    if (null === $config) {
      throw new RuntimeException("Error generating YAML data");
    }

    return $config;
  }

}
