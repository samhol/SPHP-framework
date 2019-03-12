<?php

abstract class User {

  public $name;

  public function __construct(string $name = null) {
    $this->name = $name;
  }

  public function getName(): ?string {
    return $this->name;
  }
}
