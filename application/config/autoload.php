<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('pagination', 'xmlrpc' , 'form_validation', 'email','upload', 'database', 'unit_test');
$autoload['drivers'] = array();
$autoload['helper'] = array('app', 'url','file','form','security','string','inflector','directory','download','multi_language', 'notification');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('crud_model');
