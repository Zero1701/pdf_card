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
    
    function form_errors($name, $surname, $address, $company, $position, $email, $phone){
        if (strlen($name) > 10 || strlen($name) < 3) {
            array_push($this->errors, "Name should be between 3 and 10 characters.");
            return false;
        }
        
        if (strlen($surname) > 10 || strlen($surname) < 3) {
            array_push($this->errors, "Surname should be between 3 and 10 characters.");
            return false;
        }
        
        if (strlen($address) > 20 || strlen($address) < 3) {
            array_push($this->errors, "Address should be between 3 and 20 characters.");
            return false;
        }
        
        if (strlen($email) > 30 || strlen($email) < 3) {
            array_push($this->errors, "E-mail should be between 3 and 30 characters.");
            return false;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "Invalid E-mail format.");
            return false;
        }
        if (strlen($company) > 30 || strlen($company) < 3) {
            array_push($this->errors, "Company name should be between 3 and 30 characters.");
            return false;
        }
        
        if (strlen($position) > 25 || strlen($position) < 3) {
            array_push($this->errors, "Company position should be between 3 and 25 characters.");
            return false;
        }

        
        if (strlen($phone) > 15 || strlen($phone) < 3) {
            array_push($this->errors, "Phone number should be between 3 and 15 characters.");
            return false;
        }
        return true;
    }
    
    function filepath($name){
        $currentDir = getcwd();
        $uploadDirectory = "\\pictures\\";
        $fileName = $name;
        $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
        return $uploadPath;
        
    }
    function upload($image) {
   
        $currentDir = getcwd();
        $uploadDirectory = "\\pictures\\";
        $fileExtensions = ['jpeg','jpg','png'];
        $fileName = $image['image']['name'];
        $fileSize = $image['image']['size'];
        $fileTmpName  = $image['image']['tmp_name'];

        $tmp = explode('.',$fileName);
        $fileExtension = strtolower(end($tmp));
        $uploadPath = $currentDir . $uploadDirectory . basename($fileName);
                
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
    
    function insert_user($userName, $userSurname, $address, $picture, $company, $position, $email, $phone) {
        if ($this->form_errors($userName, $userSurname, $address, $company, $position, $email, $phone)) {
          
           
               $query = "INSERT INTO `user`(`name`, `surname`, `address`, `picture`, `company`, `position`, `email`, `phone`) VALUES (?,?,?,?,?,?,?,?)";
              
               $con = new DB_con\db_con();
               $conn = $con->mysqli->prepare($query);
               $conn->bind_param('ssssssss', $userName, $userSurname, $address, $picture , $company, $position, $email, $phone);
               $conn->execute();               
                $conn->close();
              
        return true;
        }
        
    }
        
}