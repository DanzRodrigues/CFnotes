<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

class Controller {
    
    private $model_path = 'model/model.php';
    
    function index($action) {
        
        switch($action) {
            case $action === 'login':
                $this->header();
                $this->login();
                $this->footer();
                break;
            case $action === 'entrar':
                $this->entrar($_POST['usuario'], $_POST['senha']);
                break;
            case $action === 'cadastrar':
                $this->cadastrar($_POST['usuario'], $_POST['senha'], $_POST['email']);
                break;
            case $action === 'notes':
                $this->header();
                $this->notes();
                $this->footer();
                break;
            case $action === 'new':
                $this->newNote($_SESSION['user']);
                break;
            case $action === 'save':
                $this->saveNote($_SESSION['note_id'], $_POST['title'], $_POST['tag_list'], $_POST['content']);
                break;
            case $action === 'load':
                echo $this->loadUserNotes($_SESSION['user']);
                break;
            case $action === 'getNote':
                echo $this->loadNote($_POST['note_id']);
                break;
            case $action === 'delete':
                echo $this->deleteNote($_POST['note_id']);
                break;
        }
    }
    
    function login() {
        require 'view/login.php';
    }
    
    function header() {
        require 'view/header.php';
    }
    
    function footer() {
        require 'view/footer.php';
    }
    
    function notes() {
        require 'view/notes.php';
    }
    
    function newNote($user_id) {
        
        require $this->model_path;
        
        $model = New Model();
        
        $_SESSION['note_id'] = $model->insertNote($user_id);
    }

    function saveNote($note_id, $title, $tag_list, $content) {
        
        require $this->model_path;
        
        $model = New Model();
        
        $tags = explode(";", $tag_list, -1);
        
        $model->updateNote($note_id, $title, $tags, $content);
    }
    
    function loadNote($note_id) {
        
        require $this->model_path;
        
        $model = New Model();
        
        $result = $model->getNote($note_id);
        
        $_SESSION["note_id"] = $note_id;
        
        echo json_encode($result);
    }
    
    function loadUserNotes($user_id) {
        
        require $this->model_path;
        
        $model = New Model();
        
        $result = $model->getAllNotes($user_id);
        
        echo json_encode($result);
    }
    
    function deleteNote($note_id) {
        
        require $this->model_path;
        
        $model = New Model();
        
        $result = $model->deleteNote($note_id);
    }
    
    function entrar($username, $password) {
                    
        require $this->model_path;
        
        $model = new Model();
        
        $user_pass = $model->getPassword($username);
        $enc_password = md5($password);
        
        if($enc_password === $user_pass->password) {
                        
            $_SESSION["user"] = $username;
            $_POST["action"] = 'notes';
            
            echo "[user: " . $_SESSION["user"];
            echo "[action: " . $_POST["action"];
            
            $url = 'index.php';
            
            $this->redirect($url);
            
            die();
            
        } else {
            echo 'false';
        }
    }
    
    function cadastrar($username, $password, $email) {
        
        require $this->model_path;
        
        $model = new Model();
        
        $users = $model->getUsernames();
        
        $enc_password = md5($password);
        
        if($model->insertUser($username, $enc_password, $email)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
}