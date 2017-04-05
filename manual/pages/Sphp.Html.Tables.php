<?php

namespace Sphp\Html\Tables;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$table = Apis::apigen()->classLinker(Table::class);
$tr = Apis::apigen()->classLinker(Tr::class);
$td = Apis::apigen()->classLinker(Td::class);
$th = Apis::apigen()->classLinker(Th::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML TABLES

$ns

Namespace contains object oriented PHP implementation of the HTML table structure. 

##The $table component 
		
The $table Implements the HTML {$w3schools->tag("table")}. In general $table
components should not be used as layout aids.

###The structure of the $table component 
        
A basic $table is divided into rows with the $tr component (the tr stands for table row).
A row is divided into data cells with the $td tag. (td stands for table data)
A row can also be divided into headings with the $th tag. (th stands for table heading)
The $td elements are the data containers in the $table.
The $td elements can contain all sorts of HTML elements like text, images, lists, other tables, etc.
MD
);
$example = new CodeExampleBuilder('Sphp/Html/Tables/Table.php', false, true);
$example->setExamplePaneTitle('HTML table example');
$example->printHtml();
$factory = Apis::apigen()->classLinker(Factory::class);
echo $parsedown->text(<<<MD
##TABLE FACTORY: <small>The $factory Class</small>

The table factory is able to generate tables from different data sources
MD
);
$example->setExamplePaneTitle('HTML table factory example');
$example->setPath('Sphp/Html/Tables/Factory.php');
$example->printHtml();
echo $parsedown->text(<<<MD
##TABLE BUILDER: <small>The $factory Class</small>

The table builder is able to generate tables from different data sources
MD
);
$example->setExamplePaneTitle('HTML table builder example');
$example->setPath('Sphp/Html/Tables/TableBuilder.php');
$example->printHtml();