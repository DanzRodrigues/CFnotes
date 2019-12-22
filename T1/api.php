<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

session_start();

require 'control/controller.php';

$controller = New Controller();

if(isset($_GET['action']) && isset($_GET['user_id'])) {
    $action = $_GET['action'];
    
    switch($action) {
        case 'user':
            header("Content-type: application/json; charset=utf-8");
            $controller->loadUserNotes($_GET['user_id']);
            break;
        case 'notes':
            $controller->loadUserNotes($_GET['user_id']);
            break;
    }
}