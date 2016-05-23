<?php
namespace Sphp\Core;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

$em = Configuration::useDomain("manual")
        ->get(EntityManagerInterface::class);

return $em;