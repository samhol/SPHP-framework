<?php

const A = 'a';

function f(string $str = null, int $int = 0, \stdClass $obj = null): ?\stdClass {
  return $obj;
}

function f1(\stdClass $obj, $mixed): void {
  
}
