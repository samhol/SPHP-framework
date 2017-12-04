<?php

namespace Sphp\Database\Doctrine;

try {
  return EntityManagerFactory::get();
} catch (\Exception $ex) {
  echo 'foo';
}
