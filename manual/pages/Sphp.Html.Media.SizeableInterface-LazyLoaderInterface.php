<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\Manual\Apis;

$sizeableInterface = Apis::apigen()->classLinker(SizeableInterface::class);
$sizeableTrait = Apis::apigen()->classLinker(SizeableTrait::class);
$size = Apis::apigen()->classLinker(Size::class);
$componentInterface = Apis::apigen()->classLinker(\Sphp\Html\ComponentInterface::class);

$lazyLoader = Apis::apigen()->classLinker(LazyLoaderInterface::class);
$lazyLoaderTrait = Apis::apigen()->classLinker(LazyLoaderTrait::class);

echo $parsedown->text(<<<MD
##Sizeable media content and Lazy loading 
		
$sizeableInterface is implemented by components that display resizeable visual 
media content. The sizes of these components are managed by $size objects.
		
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
