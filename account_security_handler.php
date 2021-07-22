<?php
    include "literals/dbconnect.php";
    $pass_error=false;
?>

<?php
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        $oldpass = $_POST["oldpass"];
        $newpass = $_POST["newpass"];
        $confirm_newpass = $_POST["confirm_newpass"];
        $username = $_POST["username"];

        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $output = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($output);

        $password = $row['password'];

        if($password == $oldpass){
            if($newpass == $confirm_newpass){
                $sql = "UPDATE `users` SET `password` = '$newpass' WHERE `users`.`username` = '$username'";
                $pass_update = mysqli_query($conn, $sql);
                if($pass_update){
                    include "literals/pass_change_logout.php";
                    header("location: /icoder?pass_change=true");
                    exit();
                }
            }
            else{
                $pass_error="Password do not match!";
            }
        }
        else{
            $pass_error="Incorrect old password!";
        }

        if($pass_error){
            header("location: /icoder/account_security.php?pass_error=$pass_error");
        }
     }
?>