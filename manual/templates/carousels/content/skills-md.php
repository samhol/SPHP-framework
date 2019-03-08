<?php

//require_once '../../../settings.php';
use Sphp\Html\Foundation\Sites\Foundation;
use Samiholck\skillLevelBar as bar;
?>
<div id="sphp-info" markdown="1">
  <h2>SPHPlayground framework</h2>

  <?php echo Samiholck\skillLevelBar(100); ?>

  SPHPlayground is my own personal 'pet' project. 
  This framework saw first daylight in 2009 or so. It was first only a small 
  sample of tools for creating HTML components with PHP language.

  SPHPlayground is an open source framework for developing interactive web 
  applications and services in object oriented PHP. SPHPlayground is used as 
  in all my latest PHP related projects.  

  <hr> 
  <div class="button-group small align-right">
    <a class="button" href="http://playground.samiholck.com/">
      <i class="fas fa-home"></i> Official site
    </a>
    <a class="button" href="https://github.com/samhol/SPHP-framework">
      <i class="fab fa-github-square"></i> GitHub
    </a>
    <a class="button" href="http://playground.samiholck.com/API/sami/">
      <i class="fab fa-php"></i> PHP API
    </a>
    <a class="button" href="http://playground.samiholck.com/API/jsdocs/">
      <i class="fab fa-js-square"></i> JavaScript <span class="API">API</span>
    </a>
  </div>
</div>
<div id="html5-info" markdown="1">
  ##HTML5

  <?php echo Samiholck\skillLevelBar(98); ?>

  HTML5 is a markup language used for structuring and presenting content on the 
  World Wide Web. It is the fifth and current major version of the HTML standard.

  <hr>
  <div class="button-group small align-right">
    <a class="button w3c" href="https://www.w3.org/TR/2010/WD-html5-20100624/"><i class="fas fa-book"></i> w3.org</a>
    <a class="button mdn" href="https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/HTML5"><i class="fas fa-book"></i> MDN</a>
    <a class="button w3schools" href="https://www.w3schools.com/html/default.asp"><i class="fas fa-book"></i> w3schools<span class="com">.com</span></a>
  </div>

</div>
<div id="css-sass-info" markdown="1"> 
  ##CSS <small>Cascading Style Sheets</small>

  <?php echo Samiholck\skillLevelBar(98); ?>

  CSS is a stylesheet language used to describe the 
  presentation of a document written in HTML or XML (including XML dialects such 
  as SVG or XHTML). CSS describes how elements should be rendered on screen, 
  on paper, in speech, or on other media.
  <hr>
  <div class="button-group small align-right">
    <a class="button w3c" href="https://www.w3.org/Style/CSS/Overview.en.html"><i class="fas fa-book"></i> W3C</a>
    <a class="button mdn" href="https://developer.mozilla.org/en-US/docs/Web/CSS"><i class="fas fa-book"></i> MDN</a>
    <a class="button w3schools" href="https://www.w3schools.com/css/default.asp"><i class="fas fa-book"></i> w3schools<span class="com">.com</span></a>
  </div>
  ##SASS <small>Syntactically Awesome Stylesheet</small>

  <?php echo Samiholck\skillLevelBar(94); ?>

  SASS is a CSS pre-processor, which helps to reduce repetition with CSS and 
  saves time. It is stable and powerful CSS extension language that describes 
  the style of document structurally. 

  SASS makes it possible to use variables, nested rules, mixins, inline 
  imports. It helps keep large stylesheets well-organized, and get small 
  stylesheets up and running quickly, particularly with the help of the 
  [Compass](http://compass-style.org/) style library.

  <hr>
  <div class="button-group small align-right">
    <a class="button sass" href="http://sass-lang.com/"><i class="fas fa-home"></i> Sass home</a>
    <a class="button github" href="https://github.com/sass/sass"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="http://sass-lang.com/documentation/file.SASS_REFERENCE.html"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>

<div id="js-info" markdown="1">
  ##JavaScript <small>language</small>

  <?php echo Samiholck\skillLevelBar(80); ?>

  JavaScript (often shortened to JS) is a lightweight, interpreted, 
  object-oriented language with first-class functions, and is best known as the 
  scripting language for Web pages, but it's used in many non-browser 
  environments as well. 

  <hr>
  <div class="button-group small align-right">
    <a class="button js" href="https://www.javascript.com/"><i class="fab fa-js-square"></i> JavaScript<span class="com">.com</span></a>
    <a class="button mdn" href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/About_JavaScript"><i class="fas fa-book"></i> MDN</a>
    <a class="button w3schools" href="https://www.w3schools.com/js/"><i class="fas fa-book"></i> w3schools<span class="com">.com</span></a>
  </div>
</div>

<div id="nodejs-info" markdown="1">
  ##Node.js <small>a JavaScript run-time environment</small>

  <?php echo Samiholck\skillLevelBar(47); ?>

  Node.js is a platform built on Chrome's JavaScript runtime for building fast, 
  scalable network applications. Node.js uses an event-driven, non-blocking 
  I/O model that makes it lightweight and efficient, perfect for data-intensive 
  real-time applications that run across distributed devices.
  <hr>
  <div class="button-group small align-right">
    <a class="button nodejs" href="https://nodejs.org/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/nodejs"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://nodejs.org/en/docs/"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>

<div id="gulp-info" markdown="1">
  ##gulp <small>toolkit</small>

  <?php echo Samiholck\skillLevelBar(52); ?>

  gulp is a toolkit for automating painful or time-consuming tasks in 
  developmental workflow, so you can stop messing around and build something.
  <hr>
  <div class="button-group small align-right">
    <a class="button gulp" href="https://gulpjs.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/gulpjs/gulp"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://github.com/gulpjs/gulp/blob/master/docs/API.md"><i class="fas fa-book"></i> Docs</a>
    <a class="button" href="https://www.npmjs.com/package/gulp"><i class="fab fa-npm"></i> Gulp - npm</a>
  </div>
</div>

<div id="foundation-info" markdown="1">
  ##Foundation <small>framework</small>

  <?php echo Samiholck\skillLevelBar(90); ?>

  Foundation is a responsive HTML front-end framework. Foundation provides a 
  responsive grid and HTML and CSS UI components, templates, and code snippets, 
  as well as optional functionality provided by JavaScript extensions.
  <hr>
  <div class="button-group small align-right">
    <a class="button foundation" href="https://foundation.zurb.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/zurb/foundation-sites"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://foundation.zurb.com/frameworks-docs.html"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>

<div id="php-info" markdown="1">
  ##PHP <small>language</small>

  <?php echo Samiholck\skillLevelBar(95); ?>

  PHP (recursive acronym for PHP: Hypertext Preprocessor) is a open source 
  general-purpose scripting language that is especially suited for web 
  development and can be embedded into HTML.
  <hr>
  <div class="button-group small align-right">
    <a class="button php" href="https://secure.php.net"><i class="fas fa-home"></i> Official site</a>
    <a class="button gihub" href="https://github.com/php"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://secure.php.net/docs.php"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>


<div id="symfony-info" markdown="1">
  ##Symfony <small>framework</small>

  <?php echo Samiholck\skillLevelBar(45); ?>

  Symfony is a PHP web application framework and a set of reusable PHP 
  components/libraries. Symfony was published as free software on October 18, 
  2005 and released under the MIT license.
  <hr>
  <div class="button-group small align-right">
    <a class="button" href="https://symfony.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/symfony/symfony"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://symfony.com/doc/current/index.html"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>

<div id="zend-info" markdown="1">
  ##Zend <small>framework</small>

  <?php echo Samiholck\skillLevelBar(63); ?>

  Zend is an open source PHP framework. It is pure object-oriented and built 
  around the MVC design pattern. Zend framework contains collection of PHP 
  packages which can be used to develop web applications and services. 

  <hr>
  <div class="button-group small align-right">
    <a class="button zend" href="https://framework.zend.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/zendframework/zendframework"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button docs" href="https://framework.zend.com/learn"><i class="fas fa-book"></i> Docs</a>
  </div>
</div>

<div id="doctrine-info" markdown="1">
  ##Doctrine <small>framework</small>

  <?php echo Samiholck\skillLevelBar(45); ?>

  The Doctrine Project is the home to several PHP libraries primarily focused 
  on database storage and object mapping. The core projects are a Object 
  Relational Mapper (ORM) and the Database Abstraction Layer (DBAL)
  <hr>
  <div class="button-group small align-right">
    <a class="button doctrine" href="http://www.doctrine-project.org/"><i class="fas fa-home"></i> Official site</a>
    <a class="button github" href="https://github.com/doctrine"><i class="fab fa-github-square"></i> GitHub</a>
    <a class="button doctrine" href="http://www.doctrine-project.org/projects/orm.html">ORM</a>
    <a class="button doctrine" href="http://www.doctrine-project.org/projects/dbal.html">DBAL</a>
  </div>
</div>

<div id="mysql-info" markdown="1">
  ##MySQL 

  <?php echo Samiholck\skillLevelBar(59); ?>

  MySQL is an open-source relational database management system (RDBMS).
  It is a central component of the LAMP open-source web application software stack 
  (and other "AMP" stacks). LAMP is an acronym for "Linux, Apache, MySQL, 
  Perl/PHP/Python".
  <hr>
  <div class="button-group small align-right">
    <a class="button" href="https://www.mysql.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button docs" href="https://dev.mysql.com/doc/"><i class="fas fa-book"></i> Docs</a>
    <a class="button download" href="https://dev.mysql.com/downloads/"><i class="fas fa-download"></i> Downloads</a>
  </div>
</div>

<div id="postgresql-info" markdown="1">
  ##PostgreSQL

  <?php echo Samiholck\skillLevelBar(55); ?>

  PostgreSQL is an object-relational database management 
  system (ORDBMS) with an emphasis on extensibility and standards compliance. Its 
  primary functions are to store data securely and return that data in response 
  to requests from other software applications. 
  <hr>
  <div class="button-group small align-right">
    <a class="button postgresql" href="https://www.postgresql.org/"><i class="fas fa-home"></i> Official site</a>
    <a class="button docs" href="https://www.postgresql.org/docs/"><i class="fas fa-book"></i> Docs</a>
    <a class="button download" href="https://www.postgresql.org/download/"><i class="fas fa-download"></i> Downloads</a>
  </div>
</div>

<div id="sqlite-info" markdown="1">
  ##SQLite

  <?php echo Samiholck\skillLevelBar(55); ?>

  SQLite is a relational database management system. SQLite is not a client–server 
  database engine. Rather, it is embedded into the end program. SQLite is ACID-compliant 
  and implements most of the SQL standard.

  SQLite is a popular choice as embedded database software for local/client storage 
  in application software such as web browsers. It is arguably the most widely 
  deployed database engine, as it is used today by several widespread browsers, 
  operating systems, and embedded systems (such as mobile phones), among others. 
  SQLite has bindings to many programming languages.

  <hr>
  <div class="button-group small align-right">
    <a class="button sqlite" href="https://www.sqlite.org/"><i class="fas fa-home"></i> Official site</a>
    <a class="button docs" href="https://www.sqlite.org/docs.html"><i class="fas fa-book"></i> Docs</a>
    <a class="button download" href="https://www.sqlite.org/download.html"><i class="fas fa-download"></i> Downloads</a>
  </div>
</div>

<div id="java-info" markdown="1">
  ##Java <small>language</small>

  <?php echo Samiholck\skillLevelBar(54); ?>

  Java is a general-purpose computer-programming language that is concurrent, class-based, 
  object-oriented, and specifically designed to have as few implementation dependencies as possible.

  ###JDK (Java Development Kit)
  
  The JDK forms an extended subset of a software development kit (SDK). It 
  includes tools for developing, debugging, and monitoring Java applications.
  <hr>
  <div class="button-group small align-right">
    <a class="button" href="https://java.com/"><i class="fas fa-home"></i> Official site</a>
    <a class="button" href="https://docs.oracle.com/javase/9/"><i class="fas fa-book"></i> Docs</a>
    <a class="button" href="http://www.oracle.com/technetwork/java/javase/downloads/index-jsp-138363.html#javasejdk">JDK</a>
    <a class="button docs" href="https://java.com/en/download/"><i class="fas fa-download"></i> Downloads</a>
  </div>
</div>


<div id="apache-info" markdown="1">
  ##Apache HTTP Server

  <?php echo Samiholck\skillLevelBar(56); ?>

  The Apache HTTP Server is a free and open-source cross-platform web server. It 
  is developed and maintained by an open community of developers under the 
  auspices of the Apache Software Foundation.

  <hr>
  <div class="button-group small align-right">
    <a class="button" href="https://httpd.apache.org/"><i class="fas fa-home"></i> Official site</a>
    <a class="button" href="https://httpd.apache.org/docs/"><i class="fas fa-book"></i> Docs</a>
    <a class="button" href="https://httpd.apache.org/download.cgi"><i class="fas fa-download"></i> Downloads</a>
    <a class="button" href="https://en.wikipedia.org/wiki/Apache_HTTP_Server"><i class="fas fa-download"></i> Wikipedia</a>
  </div>

</div>

<div id="photoshop-info" markdown="1">
  ##Adobe Photoshop

  <?php echo Samiholck\skillLevelBar(79); ?>

  Adobe Photoshop is a raster graphics editor developed and published by Adobe 
  Systems for macOS and Windows. It has become the de facto industry standard in 
  raster graphics editing, such that the word "photoshop" has become a verb as in "to Photoshop an image.

  I have worked with many releases of **Photoshop** for nearly two decades now.

  <hr>
  <div class="button-group small align-right">
    <a class="button" href="https://www.adobe.com/fi/products/photoshop.html"><i class="fas fa-home"></i> Official site</a>
    <a class="button" href="https://helpx.adobe.com/fi/photoshop/user-guide.html"><i class="fas fa-book"></i> Docs</a>
  </div>

</div>

<div id="c-info" markdown="1">
  ##C <small>language</small>

  <?php echo Samiholck\skillLevelBar(30, 'C skills: %d%%'); ?>

  C is a general-purpose, imperative computer programming language, supporting 
  structured programming, lexical variable scope and recursion, while a static 
  type system prevents many unintended operations. C is used in many operating 
  systems, as well as various application software for computers 
  ranging from supercomputers to embedded systems.
  
  <div class="button-group small align-right">
    <a class="button" href="http://www.open-std.org/jtc1/sc22/wg14/"><i class="fas fa-book"></i>JTC1/SC22/WG14 - C</a>
    <a class="button wikibooks" href="https://en.wikibooks.org/wiki/C_Programming"><i class="fas fa-book"></i> WIKI<span class="books">BOOKS</span></a>
    <a class="button tutorialspoint" href="https://www.tutorialspoint.com/cprogramming/index.htm"><i class="fas fa-book"></i> tutorialspoint</a>
  </div>
  
  ##C++ <small>language</small>

  <?php echo Samiholck\skillLevelBar(35, 'C++ skills: %d%%'); ?>

  C++ is a general-purpose programming language. It has imperative, object-oriented 
  and generic programming features, while also providing facilities for low-level 
  memory manipulation.
  <hr>
  <div class="button-group small align-right">
    <a class="button" href="http://www.cplusplus.com/"><i class="fas fa-book"></i> cplusplus.com</a>
    <a class="button wikibooks" href="https://en.wikibooks.org/wiki/C++_Programming"><i class="fas fa-book"></i> WIKI<span class="books">BOOKS</span></a>
    <a class="button tutorialspoint" href="https://www.tutorialspoint.com/cplusplus/index.htm"><i class="fas fa-book"></i> tutorialspoint</a>
  </div>

</div>
