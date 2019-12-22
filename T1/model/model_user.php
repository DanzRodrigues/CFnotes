<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

class Model_user extends Model {
    
    function insertUser($username, $password, $email) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "INSERT INTO `user` (`username`, `password`, `email`) VALUES ('{$username}', '{$password}', '{$email}')";
        $stmt = $conn->prepare($sql);
        return $stmt->execute();
    }
    
    function getUsernames() {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
            
        $sql = "SELECT username FROM user";
        $result = $conn->query($sql);

        print_r($result);//<----
        
        return $result;
    }
    
    function getPassword($username) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
            
        $sql = "SELECT username, password FROM user where username = " . $username;
        $result = $conn->query($sql);

        print_r($result);//<----
        
        return $result;
    }
    
    function setPassword($username, $password) {
        
        $conn = $this->connectDB($this->db_username, $this->db_password);
        
        $sql = "UPDATE `user` SET password = '{$password}' WHERE username = '{$username}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
}