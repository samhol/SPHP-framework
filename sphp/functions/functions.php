<?php

namespace Sphp;

use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * 
 * @param  string $content
 * @return string
 */
function markdown(string $content, bool $echo = true): string {
  $parsed = ParseFactory::md()->parseString($content);
  if ($echo) {
    echo $parsed;
  }
  return $parsed;
}

/**
 * 
 * @param  string $content
 * @return string
 */
function inlineMarkdown(string $content, bool $echo = true): string {
  $parsed = ParseFactory::md()->parseString($content);
  if ($echo) {
    echo $parsed;
  }
  return $parsed;
}
