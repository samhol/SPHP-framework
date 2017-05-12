<?php

namespace Sphp\Db\Objects;
use Sphp\Db\EntityManagerFactory;
echo"<pre>";

      $locations = new LocationStorage(EntityManagerFactory::get());
      $locations->findAll();

echo"</pre>";
