<?php
    include "literals/header.php";
    include "literals/dbconnect.php";
    $error=false;
?>

<?php
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $output = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($output);
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $email = $row['email'];
    $country = $row['country'];
?>

<?php
     if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $country = $_POST["country"];

        $sql = "UPDATE `users` SET `firstname` = '$fname', `lastname` = '$lname', `email` = '$email', 
            `country` = '$country' WHERE `users`.`username` = '$username'";

            $update = mysqli_query($conn, $sql);
            if($update){
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                        <strong>Profile updated successfully!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
     }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/design.css">

</head>

<body style="background-color:#cec5c54d;">
    <div class="container min_height">
        <?php
            include "literals/profile_header.php";
        ?>
        <hr>

        <h3 class="pt-5">Public profile</h3>
        <hr>
        <?php
            echo '<form action="'.$_SERVER["REQUEST_URI"].'" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="fname" class="form-label"><b>First Name</b></label>
                        <input type="text" class="form-control" id="fname" name="fname" value="'.$fname.'" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="form-label"><b>Last Name</b></label>
                        <input type="text" class="form-control" id="lname" name="lname" value="'.$lname.'" required>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" class="form-control" id="email" name="email" value="'.$email.'" required>
                    </div>
                    <div class="col-md-6">
                        <label for="country" class="form-label"><b>Country</b></label>
                        <input type="text" class="form-control" id="country" name="country" value="'.$country.'" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label"><b>Username</b></label>
                        <input type="text" class="form-control" id="inputEmail4" value="'.$username.'" disabled>
                    </div>
    
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger"><b>Update profile</b></button>
                    </div>
                  </form>';
        ?>
    </div>

    <?php
            include "literals/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</body>

</html>