<?php 
// include_once 'autoload.php';

// echo "Hello World";

// $con = new DB_con\db_con();

// echo $con->db_num('select * from operator');

?>
<?php session_start(); ?>
    <!-- HTML 5 -->
        <!DOCTYPE html>
        <html>
            <head>
                <title>Login Page
                </title>
            </head>
            <body>
            <?php
                if(isset($_SESSION['name']) && $_SESSION['name'] != "")
                    {
                        echo $_SESSION['name']; ?>
                        <a href="user_form.php">New User</a>
                    <?php  }
                else{
                        header('Location: login_form.php'); //redirect URL
                    }
            ?>
        </body>
    </html>