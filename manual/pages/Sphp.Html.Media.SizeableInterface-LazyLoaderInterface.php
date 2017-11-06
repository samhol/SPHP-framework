<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\Manual\Apis;

$sizeableInterface = \Sphp\Manual\api()->classLinker(SizeableInterface::class);
$sizeableTrait = \Sphp\Manual\api()->classLinker(SizeableTrait::class);
$componentInterface = \Sphp\Manual\api()->classLinker(\Sphp\Html\ComponentInterface::class);

$lazyLoader = \Sphp\Manual\api()->classLinker(LazyMediaInterface::class);
$lazyLoaderTrait = \Sphp\Manual\api()->classLinker(LazyMediaSourceTrait::class);

\Sphp\Manual\parseDown(<<<MD
##Sizeable media content and Lazy loading 
		
$sizeableInterface is implemented by components that display resizeable visual 
media content.
		
Lazy Loading delays loading of $lazyLoader components in long web pages. $lazyLoader 
components outside of viewport are not loaded until user scrolls to them. Using 
Lazy Loading on long web pages will make the page load faster. In some cases it 
can also help to reduce server load. 

**Trait implementations of these interfaces:** 

 * $sizeableTrait implementing $sizeableInterface.    
 * $lazyLoaderTrait implementing $lazyLoader.
 
Both of these traits can be used e.g with $componentInterface when implementing new visual media content. 
MD
);
