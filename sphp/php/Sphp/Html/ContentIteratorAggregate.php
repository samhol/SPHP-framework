<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

namespace Sphp\Html;
use IteratorAggregate;
/**
 *
 * @author samih
 */
interface ContentIteratorAggregate extends IteratorAggregate{

  /**
   * Creates a new iterator to iterate through content
   *
   * @return ContentIterator<MetaData> iterator
   */
  public function getIterator(): ContentIterator;
}
