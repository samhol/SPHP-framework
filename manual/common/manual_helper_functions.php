<?php

namespace Sphp\Manual;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parser;

/**
 * 
 * @param  string $content
 * @return void
 */
function md(string $content) {
  echo Parser::md()->parseBlock($content);
}

/**
 * 
 * @param  string $content
 * @return string
 */
function inlineMd(string $content, bool $echo = true): string {
  $parsed = Parser::md()->parseInline($content);
  if ($echo) {
    echo $parsed;
  }
  return $parsed;
}

/**
 * 
 * @param  string $page
 * @throws InvalidArgumentException
 * @return void
 */
function loadPage(string $page) {
  try {
    ob_start();
    if (!Strings::endsWith($page, '.php')) {
      $page .= '.php';
    }
    $pagePath = "$page";
    if (Filesystem::isFile($pagePath)) {
      include($pagePath);
    } else {
      throw new InvalidArgumentException("the path '$page' contains no executable PHP script");
    }
    $content = ob_get_contents();
  } catch (\Exception $e) {
    $content .= (new ThrowableCallout($e))->showInitialFile()->showTrace();
  }
  ob_end_clean();
  echo $content;
}

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Manual\Sami\Sami;
use Sphp\Html\Apps\Manual\PHPManual\PHPManual;
use Sphp\Html\Apps\Manual\W3schools;
use Sphp\Html\Apps\Manual\FoundationDocsLinker;

/**
 * Return the default SPHP framework API linker
 * 
 * @return Sami 
 */
function api(): Sami {
  return Apis::sami();
}

/**
 * Return the PHP manual API linker
 * 
 * @return PHPManual 
 */
function php(): PHPManual {
  return Apis::phpManual();
}

/**
 * Return the W3Schools API linker
 * 
 * @return W3schools 
 */
function w3schools(): W3schools {
  return Apis::w3schools();
}

/**
 * Return the W3Schools API linker
 * 
 * @return FoundationDocsLinker 
 */
function foundation(): FoundationDocsLinker {
  return Apis::foundation('foundation');
}

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

/**
 * Creates the PHP Example code and the preferred result
 *
 * @param  string $path the file path of the presented example PHP code
 * @param  string|null $highlightOutput the language name of the output code 
 *         or false if highlighted output code should not be visible
 * @param  boolean $outputAsHtmlFlow true for executed HTML result or false for no execution
 * @return CodeExampleAccordionBuilder
 * @throws \Sphp\Exceptions\RuntimeException if the code example path is given and contains no file
 */
function example(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true): CodeExampleAccordionBuilder {
  return CodeExampleAccordionBuilder::build($path, $highlightOutput, $outputAsHtmlFlow);
}

/**
 * Creates the PHP Example code and the preferred result
 *
 * @param  string $path the file path of the presented example PHP code
 * @param  string|null $highlightOutput the language name of the output code  
 *         or false if highlighted output code should not be visible
 * @param  boolean $outputAsHtmlFlow true for executed HTML result or false for no execution
 * @throws \Sphp\Exceptions\RuntimeException if the code example path is given and contains no file
 */
function visualize(string $path, string $highlightOutput = null, bool $outputAsHtmlFlow = true) {
  CodeExampleAccordionBuilder::visualize($path, $highlightOutput, $outputAsHtmlFlow);
}

use Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlightingModalBuilder;
use Sphp\Html\Foundation\Sites\Containers\Modal;

/**
 * 
 * @param  mixed $trigger
 * @param  string $path
 * @param  mixed $title
 * @return Modal
 */
function codeModal($trigger, string $path, $title = 'Source code'): Modal {
  $modal = new SyntaxHighlightingModalBuilder($trigger, inlineMd($title, false));
  $modal->loadFromFile($path);
  $m = $modal->buildModal();
  $m->getTrigger()->addCssClass('manual-code-modal');
  $m->getPopup()->layout()->setSize('large');
  return $m;
}

/**
 * 
 * @param  mixed $trigger
 * @param  string $src
 * @param  mixed $title
 * @return Modal
 */
function codeModalFromString($trigger, string $src, string $lang, $title = 'Source code'): Modal {
  $modal = new SyntaxHighlightingModalBuilder($trigger, inlineMd($title, false));
  $modal->setSource($src, $lang, true);
  $m = $modal->buildModal();
  $m->getTrigger()->addCssClass('manual-code-modal');
  $m->getPopup()->layout()->setSize('large');
  return $m;
}
