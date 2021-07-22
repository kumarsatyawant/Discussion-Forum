<?php
    $error = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $country = $_POST["country"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $output = mysqli_query($conn, $sql);
        $exists = mysqli_num_rows($output);

        if($exists > 0){
            $error = "Username not available. Please choose another!";
        }
        else{
            if($password == $confirm_password){
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`firstname`, `lastname`, `email`, `country`, `username`, `password`, `created`) 
                        VALUES ('$fname', '$lname', '$email', '$country', '$username', '$password', CURRENT_TIMESTAMP())";
     
                $output = mysqli_query($conn, $sql);

                if($output){
                    header("location: /icoder/home.php?signup=true");
                    exit();
                }
            }
            else{
                $error = "Password do not match. Please try again!";
            }
        }

        header("location: /icoder/home.php?signup=false&error=$error");
    }
?>