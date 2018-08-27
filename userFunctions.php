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
        if (strlen($userName) > 10 || strlen($userName) < 4) {
            array_push($this->errors, "Username should be between 4 and 10 characters.");
            return false;
        }
        
        if (strlen($password) > 15 || strlen($password) < 4) {
            array_push($this->errors, "Password should be between 6 and 10 characters.");
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
       // echo $uploadPath;
        
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
    
    function login($userName, $password) {
        if ($this->form_errors($userName, $password)) {
          
           
               $query = "SELECT `ID`, `name`, `surname`, `user_name`, `password`, `created_on`, `updated_on` FROM `operator` WHERE `user_name` = ? and password = md5(?)";
              
               $con = new DB_con\db_con();
               $conn = $con->mysqli->prepare($query);
               $conn->bind_param('ss', $userName, $password);
               $conn->execute();
               $conn->bind_result($id, $name, $surname, $user_name, $password, $created_on, $updated_on);
              
              while($conn->fetch()) {
                  $operator = new \Db_table\operator($id, $name, $surname, $user_name, $password, $created_on, $updated_on);   
                }
                if($conn->num_rows == 0) {array_push($this->errors, "Invalid username or password"); return false;}
                $_SESSION['id'] = $operator->getId();
                $_SESSION['name'] = $operator->getName();
                $_SESSION['surname'] = $operator->getSurname();
               
                $conn->close();
              
        return true;
        }
        
    }
}