<?php

namespace Sphp\Html\Tables;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Manual;

$table = Manual\api()->classLinker(Table::class);
$tr = Manual\api()->classLinker(Tr::class);
$td = Manual\api()->classLinker(Td::class);
$th = Manual\api()->classLinker(Th::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$w3schools = Manual\w3schools();
Manual\md(<<<MD
#HTML TABLES: <small>for tabular data</small>

$ns

Namespace contains object oriented PHP implementation of the HTML table structure. 
Table element represents tabular data —that is, information expressed via a 
two-dimensional data table. Therefore <u>HTML tables should not be used as layout aids</u>.

##The $table component 
		
The $table Implements the HTML {$w3schools->tag("table")}. 

###The structure of the $table component 
        
A basic $table is divided into rows with the $tr component (the tr stands for table row).
A row is divided into data cells with the $td tag. (td stands for table data)
A row can also be divided into headings with the $th tag. (th stands for table heading)
The $td elements are the data containers in the $table.
The $td elements can contain all sorts of HTML elements like text, images, lists, other tables, etc.
MD
);
Manual\example('Sphp/Html/Tables/Table.php', null, true)
        ->setExamplePaneTitle('HTML table example')
        ->printHtml();

$tableBuilder = Manual\api()->classLinker(TableBuilder::class);
Manual\md(<<<MD
##TABLE BUILDER: <small>The $tableBuilder Class</small>

This builder is able to generate tables from data sources
MD
);
Manual\example('Sphp/Html/Tables/TableBuilder.php')
        ->setExamplePaneTitle('HTML table builder example')
        ->printHtml();
Manual\md(<<<MD
###HTML TABLES FROM CSV-FILES: <small>The $tableBuilder Class as a factory</small>

{$tableBuilder->methodLink('fromCsvFile')} is a factory method for generating tables from CSV files.
MD
);
Manual\example('Sphp/Html/Tables/Factory.php')
        ->setExamplePaneTitle('HTML table factory example')
        ->printHtml();
