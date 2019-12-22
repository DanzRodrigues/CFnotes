<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */


require 'init.php';
require 'control/controller.php';

$controller = New Controller();

$controller->index($_POST['action']);
   