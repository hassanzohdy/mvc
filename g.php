<?php
class Foo
{
   public $bar = "alaa";

   public function __construct() {
	   $v = 'bar';
	   $this->$v;
	   print $this->bar;
   }
}

$foo = new Foo();

