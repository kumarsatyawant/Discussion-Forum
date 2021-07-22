<?php
    //$loginerror = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $username = $_POST["login_username"];
        $password = $_POST["login_password"];
        
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $output = mysqli_query($conn, $sql);
        $no_row = mysqli_num_rows($output);

        if($no_row == 1){
            $row=mysqli_fetch_assoc($output);
            $post_id = $row['user_id'];
            if($password == $row['password']){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['poster'] = $post_id;
                //echo "Login successful!";
                header("location: /icoder/home.php");
                exit();
            }
            else{
                $loginerror = "Invalid Password.";
            }
        }
        else{
            $loginerror = "Invalid Username.";
        }

        header("location: /icoder/home.php?loginerror=$loginerror");
    }
?>