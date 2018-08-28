<?php
include_once 'autoload.php';
class userIndex {
    public $errors = array();
    
    function checkInput($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripcslashes($input);
        return $input;
    }
    
    
    function filepath(){
        $currentDir = getcwd();
        $project = "\\pdf\\";
        $uploadDirectory = "\pdfs\\";
        $fileName = "Business card";
        $uploadPath = $project . $uploadDirectory . basename($fileName);
        return $uploadPath;
        
    }
   
    
    function allUsers() {

            
            
            $query = "SELECT `id`,`name`,`surname`,`address`,`picture`,`company`,`position`,`email`,`phone` FROM `user`";
            
            $con = new DB_con\db_con();
            $conn = $con->mysqli->prepare($query);
            $conn->execute();
            $conn->bind_result($id, $name, $surname, $address, $picture, $company, $position, $email, $phone);
            $userData = array();
            while($conn->fetch()) {
   
                $users = new \Db_table\user($id, $name, $surname, $address, $picture, $company, $position, $email, $phone);
                array_push($userData, $users);
            }

            
            $conn->close();
            
            return $userData;
        }
        
        function maxID() {
            
            
            
            $query = "SELECT max(`id`) FROM `user`";
            
            $con = new DB_con\db_con();
            $conn = $con->mysqli->prepare($query);
            $conn->execute();
            $conn->bind_result($id);
            $max_id = 0;
            while($conn->fetch()) {
                
         $max_id = $id;
            }
            
            
            $conn->close();
            
            return $max_id;

        }
        
        
}