<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

class Cntrl_user {

    private $model_path = 'model/model.php';
    
    function login($username, $password) {
                    
        require $this->model_path;
        
        $model = new Model();
        
        $user_pass = $model->getPassword($username);
        $enc_password = md5($password);
        
        if($enc_password === $user_pass->password) {
                        
            $_SESSION["user_id"] = $username;
            $_POST["action"] = 'notes';
            
            echo "[user: " . $_SESSION["user_id"];
            echo "[action: " . $_POST["action"];
            
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

