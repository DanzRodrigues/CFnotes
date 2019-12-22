<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

class Model {
    
    private $db_username = 'root';
    private $db_password = '';
    private $db_host = 'localhost';
    private $db_name = 'notedb';
    
    function setDB($host, $dbname, $user, $password) {
        $this->db_host = $host;
        $this->db_name = $dbname;
        $this->db_username = $user;
        $this->db_password = $password;
    }
    
    function connectDB($username, $password) {
        try {
            $conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name , $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
            
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return null;
        }
    }
    
    function getUser($user_id) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "SELECT * FROM user WHERE user_id = '{$user_id}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        
        return $stmt->fetchAll();
    }
    
    function insertUser($username, $password, $email) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "INSERT INTO `user` (`username`, `password`, `email`) VALUES ('{$username}', '{$password}', '{$email}')";
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    function getUsernames() {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
            
        $sql = "SELECT email, username FROM user";
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
            return $stmt->fetchAll();
        } else {
            echo '\n\n PDO ERROR \n\n';
        }
    }
    
    function getPassword($username) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
            
        $sql = "SELECT username, password FROM user where username = '{$username}'";
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            return $stmt->fetch();
        } else {
            return null;
        }
    }
    
    function setPassword($username, $password) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "UPDATE `user` SET password = '{$password}' WHERE username = '{$username}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
            
    function getNote($note_id) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $stmt = $conn->prepare("SELECT * FROM note where note_id =" . $note_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        
        return $stmt->fetchAll();
    }

    function getAllNotes($user_id) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "SELECT * FROM note where user_id = '{$user_id}'";
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } else {
            echo '\n\n PDO ERROR \n\n';
        }  
    }
    
    function getSomeNotes($tag) {
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "JOIN note, tag_note";
        $stmt = $conn->prepare($sql);
        
        $sql = "SELECT * FROM note where user_id = '{$user_id}'";
        $stmt = $conn->prepare($sql);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        } else {
            echo '\n\n PDO ERROR \n\n';
        } 
    }
    
    function deleteNote($note_id) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "DELETE FROM note WHERE note_id = " . $note_id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        exit();
    }
    
    function insertNote($user_id) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "INSERT INTO `note` (`title`, `content`, `user_id`) VALUES ('', '', '{$user_id}')";       
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        // falta tratar tags
        
        return $conn->lastInsertId();
    }
    
    function updateNote($note_id, $title, $tag_list, $content) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "UPDATE note SET title='{$title}', content='{$content}' WHERE note_id =".$note_id;       
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $sql = "SELECT * from tag";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_KEY_PAIR);
        $fetched_tags = $stmt->fetchAll();
                
        foreach($tag_list as $tag) {
            if(!in_array($tag, $fetched_tags)) {
                echo "\n1 tag: " . $tag . "\n";
                                
                print_r($fetched_tags);
                
                $sql = "INSERT INTO `tag` (`name`) VALUES ('{$tag}')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $tag_id = $conn->lastInsertId();
                
                $sql = "INSERT INTO `tag_note` (`tag_id`, `note_id`) VALUES ('{$tag_id}', '{$note_id}')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            } else {
                echo "\n2 tag: " . $tag . "\n";
                print_r($fetched_tags);
                
                $sql = "SELECT tag_id from tag WHERE name = '{$tag}'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $tag_obj = $stmt->fetch();
                
                echo "\ntag_id: " . $tag_obj->tag_id . "\n";
                
                $sql = "INSERT INTO `tag_note` (`tag_id`, `note_id`) VALUES ('{$tag_obj->tag_id}', '{$note_id}')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
            }
        }
    }
}

