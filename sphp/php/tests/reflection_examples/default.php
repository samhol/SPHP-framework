<?php

function foobar(): void {
  
}

interface Bazzy {

  public function doFoo(float $duh): void;
}

class Baz implements Bazzy {

  public function doFoo(float $duh): void {
    echo $duh;
  }

}
