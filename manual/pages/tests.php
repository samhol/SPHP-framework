<?php

use Sphp\DateTime\DateInterface;

function foo($date): string {
  $result = null;
  if (is_null($date)) {
    $result = (new DateTimeImmutable('today'))->format('Y-m-d');
  } else if (is_string($date)) {
    $result = (new DateTimeImmutable($date))->format('Y-m-d');
  } else if (is_int($date)) {
    $result = (new DateTimeImmutable())->setTimestamp($date)->format('Y-m-d');
  } else if ($date instanceof DateInterface || $date instanceof \DateTimeInterface) {
    $result = $date->format('Y-m-d');
  }
  if ($result === null) {
    throw new DateTimeException(' object cannot be parsed from input type');
  }
  return $result;
}

function parse($date): DateTimeImmutable {
  $result = null;
  if (is_null($date)) {
    $result = new DateTimeImmutable('today');
  } else if (is_string($date)) {
    $result = new DateTimeImmutable($date);
  } else if (is_int($date)) {
    $result = (new DateTimeImmutaebl())->setTimestamp($date);
  } else if ($date instanceof DateTimeImmutable) {
    $result = $date;
  } else if ($date instanceof DateInterface || $date instanceof \DateTimeInterface) {
    $result = new DateTimeImmutable($date->format('Y-m-d'));
  }
  if ($result === null) {
    throw new DateTimeException(' object cannot be parsed from input type');
  }
  return $result;
}

echo '<pre>';
echo "\n" . foo(new \Sphp\DateTime\Date());
echo "\n" . foo(new \Sphp\DateTime\Date('2001-2-3 20:02 EET'));
echo "\n" . foo(new \Sphp\DateTime\DateTime('2001-2-3 20:02 EET'));
echo "\n" . foo(243563434);
echo "\n" . foo(0);
echo "\n" . foo('today');
echo "\n" . parse('2001-2-3 20:02 EET')->format('Y-m-d');
echo '</pre>';
