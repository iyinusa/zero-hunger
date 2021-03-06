<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$CI =& get_instance();
 $buffer = $CI->output->get_output();
 
 $search = array(
    '/\>[^\S ]+/s', 
    '/[^\S ]+\</s', 
     '/(\s)+/s', // shorten multiple whitespace sequences
  '#(?://)?<!\[CDATA\[(.*?)(?://)?\]\]>#s' //leave CDATA alone
  );
 $replace = array(
     '>',
     '<',
     '\\1',
  "//&lt;![CDATA[\n".'\1'."\n//]]>"
  );
 
 $buffer = preg_replace($search, $replace, $buffer);
 
 $CI->output->set_output($buffer);
 $CI->output->_display();
