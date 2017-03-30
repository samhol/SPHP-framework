<?php

namespace Sphp\Html;

$api = $container->get("apiGen");
$phpLinker = $container->get("phpLinker");
$parser = $container->get("parseDown");
$abstractTag = $api->classLinker(AbstractTag::class);


(new SyntaxHighlighter())->loadFromFile("/html/ajax.php")->printHtml();
echo $parser->text(<<<MD
##Namespace {$api->namespaceLink(__NAMESPACE__)}
HTML or HyperText Markup Language is the standard markup language used to create Web pages.

HTML is written in the form of HTML elements consisting of tags enclosed in angle brackets (like &lt;html&gt;). 
HTML tags most commonly come in pairs like &lt;h1&gt; and &lt;/h1&gt;, although some tags represent 
empty elements and so are unpaired, for example &lt;img&gt;. The first tag in a pair is the start tag, and the second 
tag is the end tag (they are also called opening tags and closing tags).[[Wikipedia]]

[Wikipedia]: http://en.wikipedia.org/wiki/HTML

The content of the {$api->namespaceLink(__NAMESPACE__)} namespace
enables the creation of the HTML documents in object oriented PHP.
	
This PHP framework started first as an implementation of the basic html structure in PHP language. 
Therefore the basic interfaces and their build in class implementations describe these HTML properties quite extensively.

**Links to HTML-resources:**

* <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
* <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
* <a href="http://validator.w3.org/">W3C Markup Validation Service</a>

##Base interfaces and classes for HTML component creation in the framework

###The {$apigenClass(ContentInterface::class)} interface

All {$api->namespaceLink(__NAMESPACE__)} components implement at least {$apigenClass(ContentInterface::class)}. This
interface ensures that the component can be outputted to an HTML document via the following three methods.


1. {$api->getClassMethodLink(ContentInterface::class, "getHtml")} returns the component as an HTML string
2. {$api->getClassMethodLink(ContentInterface::class, "__toString")} returns the component as an HTML string (PHP's magic method {$phpLinker->getHyperlink("language.oop5.magic.php#object.tostring", "toString()", "Magic toString method")})
3. {$api->getClassMethodLink(ContentInterface::class, "printHtml")} output the component as an HTML string


Trait {$apigenClass(ContentTrait::class)} gives an implementation to the subsequent
two of these methods leaving the implementation of the {$api->getClassMethodLink(ContentInterface::class, "getHtml")} 
to the inheritor. Using this trait ensures that {$api->getClassMethodLink(ContentInterface::class, "__toString")}
will never throw any type of {$phpLinker->getClassLink(\Exception::class)} during execution.

###The {$api->classLinker(ComponentInterface::class)} interface and its $abstractTag implementation

The {$api->classLinker(ComponentInterface::class)} interface declares a group of methods for HTML attribute handling.
It is implemented in the {$apigenClass(AttributeTrait::class)} trait and also in the abstract class $abstractTag.
$abstractTag is the first actual PHP implementation of a HTML tag in the framework. 
It also defines the tagname property in {$api->getClassMethodLink(AbstractTag::class, "__construct")}. 

###The {$api->classLinker(EmptyTag::class)} class and empty `HTML` elements

The {$api->classLinker(EmptyTag::class)} class is used to generate empty HTML elements like &lt;img&gt;, &lt;br&gt;, &lt;hr&gt;, &lt;input&gt;, ...

###The {$api->classLinker(ContainerComponentInterface::class)} and {$api->classLinker(ContainerInterface::class)} interfaces

The {$api->classLinker(ContainerInterface::class)} declares the properties fot a HTML container. 
Such container can store anything that can be output as a PHP string. The simplest build in implementor for the
{$api->classLinker(ContainerInterface::class)} is {$api->classLinker(Container::class)}. 
An object of this class outputs only its content  to the HTML document. 


The {$api->classLinker(ContainerComponentInterface::class)} declares the properties fot a HTML wrapper element (a tag pair) acting as a 
container for other elements. It has a implementation {$api->classLinker(ContainerTag::class)} in the framework. 

Furthermore all actual framework components implement {$api->classLinker(ComponentInterface::class)}

###The {$api->classLinker(Document::class)} class
MD
);
