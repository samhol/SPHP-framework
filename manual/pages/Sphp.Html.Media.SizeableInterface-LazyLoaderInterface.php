<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$sizeableInterface = Manual\api()->classLinker(SizeableMedia::class);
$sizeableTrait = Manual\api()->classLinker(SizeableTrait::class);
$componentInterface = Manual\api()->classLinker(\Sphp\Html\ComponentInterface::class);

$lazyLoader = Manual\api()->classLinker(LazyMedia::class);
$lazyLoaderTrait = Manual\api()->classLinker(LazyMediaSourceTrait::class);

Manual\parseDown(<<<MD
##Sizeable media content and Lazy loading 
  
$sizeableInterface is implemented by components that display resizeable visual 
media content.

Lazy Loading delays loading of $lazyLoader components in long web pages. $lazyLoader 
components outside of viewport are not loaded until user scrolls to them. Using 
Lazy Loading on long web pages will make the page load faster. In some cases it 
can also help to reduce server load. 
       
<div class="callout secondary" markdown="1"> 
###Lazy Load XT jQuery plugin
This framework uses Lazy Load XT jQuery plugin. It is Mobile-oriented, fast 
and extensible jQuery plugin with build-in support of jQueryMobile framework.
</div>

**Trait implementations of these interfaces:** 

 * $sizeableTrait implementing $sizeableInterface.    
 * $lazyLoaderTrait implementing $lazyLoader.
 
Both of these traits can be used e.g with $componentInterface when implementing new visual media content. 
MD
);
