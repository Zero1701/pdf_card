<?php
include_once 'autoload.php';
class userFunctions {
    public $errors = array();
    
    function checkInput($input) {
        $input = htmlspecialchars($input);
        $input = trim($input);
        $input = stripcslashes($input);
        return $input;
    }
    
    function form_errors($userName, $password){
        if (strlen($userName) > 10 || strlen($userName) < 3) {
            array_push($this->errors, "Name should be between 3 and 10 characters.");
            return false;
        }
        
        if (strlen($password) > 10 || strlen($password) < 3) {
            array_push($this->errors, "Surname should be between 3 and 10 characters.");
            return false;
        }
        
        return true;
    }
    
    function upload($image) {
        print_r($image);
        $currentDir = getcwd();
        $uploadDirectory = "\\pictures\\";
        $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
        $fileName = $image['image']['name'];
        $fileSize = $image['image']['size'];
        $fileTmpName  = $image['image']['tmp_name'];
     //   $fileType = $image['image']['type'];
        $tmp = explode('.',$fileName);
        $fileExtension = strtolower(end($tmp));
        $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
        echo $uploadPath;
        
            if (! in_array($fileExtension,$fileExtensions)) {
                $this->errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            }
            
            if ($fileSize > 2000000) {
                $this->errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            }
            if (empty($this->errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                if ($didUpload) {
                    echo "The file " . basename($fileName) . " has been uploaded";
                } else {
                    echo "An error occurred somewhere. Try again or contact the admin";
                }
            } else {
                foreach ($this->errors as $error) {
                    echo $error . "These are the errors" . "\n";
                }
            }
    }
    
    function insert_user($userName, $userSurname, $gender, $address, $picture) {
        if ($this->form_errors($userName, $userSurname)) {
          
           
               $query = "INSERT INTO `user`(`name`, `surname`, `gender`, `address`, `picture`) VALUES (?,?,?,?,?)";
              
               $con = new DB_con\db_con();
               $conn = $con->mysqli->prepare($query);
               $conn->bind_param('ssiss', $userName, $userSurname, $gender, $address, $picture);
               $conn->execute();               
                $conn->close();
              
        return true;
        }
        
    }
    
    function checkIfUserExists($userName, $userSurname) {
        if ($this->form_errors($userName, $userSurname)) {
            
            
            $query = "SELECT `name` , `surname` FROM `user` WHERE `name` = ? AND `surname` = ?";
            
            $con = new DB_con\db_con();
            $conn = $con->mysqli->prepare($query);
            $conn->bind_param('ss', $userName, $userSurname);
            $conn->execute();
            if($conn->get_result()->num_rows == 0) {array_push($this->errors, "Invalid username or password"); return true;}
            else {
                return false;
            }
            
            $conn->close();
            
        }
        
    }
}